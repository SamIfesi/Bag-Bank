<?php
// Disable HTML error output - TEMPORARILY ENABLED FOR DEBUGGING
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

// Handle Preflight OPTIONS request (if CORS is an issue, though same-origin usually fine)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header("HTTP/1.1 200 OK");
    exit;
}

require_once __DIR__ . "/../../config/functions/utilities.php";
require_once __DIR__ . "/../../config/Auth.php";

// Load Gemini API Key from environment (Railway sets this directly)
// Use getenv() FIRST - it's the most reliable for Railway
// Then fall back to $_ENV and $_SERVER for local development
$gemini_key = getenv('GEMINI_API_KEY') ?: ($_ENV['GEMINI_API_KEY'] ?? '') ?: ($_SERVER['GEMINI_API_KEY'] ?? '') ?: '';
define('GEMINI_API_KEY', $gemini_key);

// Auth Check
if (!isset($_SESSION['user'])) {
    header('Content-Type: application/json');
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

// JSON Header
header('Content-Type: application/json');

try {
    // User Data
    $user = Auth::user();
    if (!$user) {
        throw new Exception("User not found or Database Error");
    }
} catch (Throwable $e) {
    echo json_encode(['success' => false, 'message' => 'System Error: ' . $e->getMessage()]);
    exit;
}

$input = file_get_contents('php://input');
$data = json_decode($input, true);
$user_message = trim($data['message'] ?? '');

if (empty($user_message)) {
    echo json_encode(['success' => false, 'message' => 'Say something!']);
    exit;
}

try {
    // 2. Prepare Context (safely)
    $name = $user->name ?? 'User';
    $acct = $user->account_number ?? 'N/A';
    $bal  = isset($user->balance) ? number_format($user->balance, 2) : '0.00';

    // System Prompt
    $context = "
ROLE: You are 'Baggy', a helpful financial AI for D'Bag Bank.
USER: {$name}, Balance: ₦{$bal}, Account: {$acct}
PERSONALITY: Warm, professional, helpful. Use Nigerian Naira (₦).
MESSAGE: \"{$user_message}\"
REPLY:
";

    // Call AI
    $ai_response = callGeminiAPI($context);

    if ($ai_response['success']) {
        echo json_encode([
            'success' => true,
            'message' => $ai_response['message'],
            'timestamp' => date('g:i A')
        ]);
    } else {
        // Pass the specific error up
        throw new Exception($ai_response['error']);
    }
} catch (Throwable $e) {
    // Log error for server admin
    error_log("AI API/System Error: " . $e->getMessage());

    // Fallback response for user
    $fallback = getSmartFallback($user_message, $user);

    // Send fallback + Log the error in the console message for debugging
    echo json_encode([
        'success' => true,
        'message' => $fallback,
        'timestamp' => date('g:i A'),
        'debug_error' => $e->getMessage()
    ]);
}
exit;

function callGeminiAPI($prompt)
{
    $api_key = trim(GEMINI_API_KEY);

    // Explicit check for missing API key
    if (empty($api_key)) {
        return ['success' => false, 'error' => "API Key is missing in environment variables."];
    }

    // Use gemini-1.5-flash as it is more stable/confirmed working in tests
    $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=" . $api_key;

    $body = [
        'contents' => [
            [
                'parts' => [
                    ['text' => $prompt]
                ]
            ]
        ]
    ];
    $json_body = json_encode($body);

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Content-Length: ' . strlen($json_body)
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_body);

    // SSL Bypass for Localhost
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curl_error = curl_error($ch);
    curl_close($ch);

    if ($curl_error) {
        return ['success' => false, 'error' => "Connection Error: $curl_error"];
    }

    $result = json_decode($response, true);

    if ($http_code === 200 && isset($result['candidates'][0]['content']['parts'][0]['text'])) {
        return [
            'success' => true,
            'message' => $result['candidates'][0]['content']['parts'][0]['text']
        ];
    }

    // Capture the actual Google Error Message
    $google_error_msg = $result['error']['message'] ?? 'Unknown Error';
    $raw_response = substr($response, 0, 500); // First 500 chars for debugging
    return ['success' => false, 'error' => "API Error ($http_code): $google_error_msg | Key length: " . strlen($api_key)];
}

// ---------------------------------------------------------
// 🛡️ SMART FALLBACK
// ---------------------------------------------------------
function getSmartFallback($msg, $user)
{
    $msg = strtolower($msg);
    $bal = isset($user->balance) ? number_format($user->balance, 2) : '0.00';

    if (strpos($msg, 'balance') !== false) return "Your balance is **₦{$bal}**.";
    if (strpos($msg, 'transfer') !== false) return "Click **Transfer** on your dashboard to send money.";

    return "I'm having a connection issue (Error 404), but I can still see your balance is **₦{$bal}**.";
}
