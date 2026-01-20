<?php
ini_set('display_errors', 0);
error_reporting(0);

session_start();

// ---------------------------------------------------------
// Dependencies
// ---------------------------------------------------------
require_once __DIR__ . "/../../config/functions/utilities.php";
require_once __DIR__ . "/../../config/Auth.php";

// ---------------------------------------------------------
// Constants
// ---------------------------------------------------------
define('GEMINI_API_KEY', getenv('GEMINI_API_KEY') ?: ($_ENV['GEMINI_API_KEY'] ?? '') ?: ($_SERVER['GEMINI_API_KEY'] ?? ''));
define('GEMINI_MODEL', 'gemini-2.5-flash');
define('GEMINI_API_URL', 'https://generativelanguage.googleapis.com/v1beta/models/' . GEMINI_MODEL . ':generateContent');

// ---------------------------------------------------------
// CORS Preflight Handler
// ---------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header("HTTP/1.1 200 OK");
    exit;
}

// ---------------------------------------------------------
// Authentication Check
// ---------------------------------------------------------
if (!isset($_SESSION['user'])) {
    sendJsonResponse(false, 'Unauthorized', 401);
}

// ---------------------------------------------------------
// Set Response Headers
// ---------------------------------------------------------
header('Content-Type: application/json');

// ---------------------------------------------------------
// Get Authenticated User
// ---------------------------------------------------------
try {
    $user = Auth::user();
    if (!$user) {
        throw new Exception("User not found");
    }
} catch (Throwable $e) {
    sendJsonResponse(false, 'System Error: ' . $e->getMessage());
}

// ---------------------------------------------------------
// Parse & Validate Input
// ---------------------------------------------------------
$input = json_decode(file_get_contents('php://input'), true);
$userMessage = trim($input['message'] ?? '');

if (empty($userMessage)) {
    sendJsonResponse(false, 'Please enter a message');
}

// ---------------------------------------------------------
// Process Chat Request
// ---------------------------------------------------------
try {
    $prompt = buildPrompt($user, $userMessage);
    $aiResponse = callGeminiAPI($prompt);

    if ($aiResponse['success']) {
        sendJsonResponse(true, $aiResponse['message']);
    } else {
        throw new Exception($aiResponse['error']);
    }
} catch (Throwable $e) {
    error_log("AI Chat Error: " . $e->getMessage());
    $fallback = getSmartFallback($userMessage, $user);
    sendJsonResponse(true, $fallback);
}

// =============================================================================
// HELPER FUNCTIONS
// =============================================================================

/**
 * Send a JSON response and exit
 */
function sendJsonResponse(bool $success, string $message, int $httpCode = 200): void
{
    header('Content-Type: application/json');
    http_response_code($httpCode);
    echo json_encode([
        'success'   => $success,
        'message'   => $message,
        'timestamp' => date('g:i A')
    ]);
    exit;
}

/**
 * Build the AI prompt with user context
 */
function buildPrompt(object $user, string $message): string
{
    $name    = $user->name ?? 'User';
    $account = $user->account_number ?? 'N/A';
    $balance = isset($user->balance) ? number_format($user->balance, 2) : '0.00';

    return <<<PROMPT
ROLE: You are 'Baggy', a helpful financial AI assistant for D'Bag Bank.

USER CONTEXT:
- Name: {$name}
- Account Number: {$account}
- Current Balance: ₦{$balance}

GUIDELINES:
- Be warm, professional, and helpful
- Always use Nigerian Naira (₦) for currency
- Keep responses concise but informative
- If asked about transactions, guide them to the appropriate dashboard feature

USER MESSAGE: "{$message}"

YOUR RESPONSE:
PROMPT;
}

/**
 * Call Google Gemini API
 */
function callGeminiAPI(string $prompt): array
{
    $apiKey = trim(GEMINI_API_KEY);

    if (empty($apiKey)) {
        return ['success' => false, 'error' => 'API key not configured'];
    }

    $url = GEMINI_API_URL . '?key=' . $apiKey;

    $payload = json_encode([
        'contents' => [
            ['parts' => [['text' => $prompt]]]
        ]
    ]);

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST           => true,
        CURLOPT_HTTPHEADER     => [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($payload)
        ],
        CURLOPT_POSTFIELDS     => $payload,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_TIMEOUT        => 30
    ]);

    $response  = curl_exec($ch);
    $httpCode  = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    curl_close($ch);

    if ($curlError) {
        return ['success' => false, 'error' => "Connection failed: $curlError"];
    }

    $result = json_decode($response, true);

    if ($httpCode === 200 && isset($result['candidates'][0]['content']['parts'][0]['text'])) {
        return [
            'success' => true,
            'message' => $result['candidates'][0]['content']['parts'][0]['text']
        ];
    }

    $errorMessage = $result['error']['message'] ?? 'Unknown API error';
    return ['success' => false, 'error' => "API Error ($httpCode): $errorMessage"];
}

/**
 * Generate smart fallback responses when AI is unavailable
 */
function getSmartFallback(string $message, object $user): string
{
    $message = strtolower($message);
    $balance = isset($user->balance) ? number_format($user->balance, 2) : '0.00';

    $responses = [
        'balance'  => "Your current balance is **₦{$balance}**.",
        'transfer' => "To send money, click **Transfer** on your dashboard.",
        'send'     => "To send money, click **Transfer** on your dashboard.",
        'card'     => "You can manage your ATM card from the **Cards** section.",
        'help'     => "I'm here to help! You can ask about your balance, transfers, or account details.",
        'hello'    => "Hello! 👋 How can I assist you today?",
        'hi'       => "Hi there! 👋 What can I help you with?",
    ];

    foreach ($responses as $keyword => $response) {
        if (strpos($message, $keyword) !== false) {
            return $response;
        }
    }

    return "I'm experiencing a brief connection issue, but I can still help! Your balance is **₦{$balance}**. Try asking again in a moment.";
}
