<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once __DIR__ . "/../../app/model/model.php";
require_once __DIR__ . "/../../config/functions/utilities.php";
require_once __DIR__ . "/../../config/Auth.php";
require_once __DIR__ . "/../../includes/check_auth.php";

// Set JSON header
header('Content-Type: application/json');

if (!isset($_SESSION['user'])) {
    http_response_code(401);
    echo json_encode([
        'success' => false,
        'message' => 'User not logged in'
    ]);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get POST data
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    $amount = floatval($data['amount'] ?? 0);
    $payment_method = sanitize_input($data["payment_method"] ?? '');
    $description = sanitize_input($data["description"] ??  'Wallet top-up');

    // Validation
    if (empty($amount) || $amount <= 0 || ! is_numeric($amount)) {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => 'Invalid amount'
        ]);
        exit;
    }

    if ($amount < 100) {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => 'Minimum amount is ₦100.00'
        ]);
        exit;
    }

    if ($amount > 10000) {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => 'Maximum amount is ₦10,000.00 per transaction'
        ]);
        exit;
    }

    if (empty($payment_method) || !in_array($payment_method, ['card', 'bank', 'ussd'])) {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => 'Invalid payment method'
        ]);
        exit;
    }

    // Get user
    $user_id = $_SESSION['user'];
    $user = Model::find('users', 'id', $user_id);

    if (! $user) {
        http_response_code(404);
        echo json_encode([
            'success' => false,
            'message' => 'User not found'
        ]);
        exit;
    }

    try {
        // Start transaction
        $db = new Database();
        $db->getPdo()->beginTransaction();

        // Update user balance
        $newBalance = $user->balance + $amount;
        $updateUser = Model::update('users', ['balance' => $newBalance], $user->id);

        if (! $updateUser) {
            $db->getPdo()->rollBack();
            throw new Exception('Failed to update balance');
        }

        // Generate transaction reference
        $transaction_ref = 'ADD' . time() . rand(1000, 9999);

        // Create transaction record
        $transactionData = [
            'user_id' => $user->id,
            'type' => 'credit',
            'amount' => $amount,
            'recipient_name' => null,     
            'recipient_account' => null,
            'sender_account' => $payment_method,
            'sender_name' => ucfirst($payment_method) . ' Payment',
            'bank_name' => "D'bag Bank",
            'bank_code' => 'add_money',
            'description' => $description,
            'status' => 'success',
            'reference' => $transaction_ref,
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $createTransaction = Model::create('transactions', $transactionData);

        if (!$createTransaction) {
            $db->getPdo()->rollBack();
            throw new Exception('Failed to create transaction record');
        }

        // Commit transaction
        $db->getPdo()->commit();

        http_response_code(200);
        echo json_encode([
            'success' => true,
            'message' => 'Money added successfully',
            'new_balance' => number_format($newBalance, 2),
            'amount_added' => number_format($amount, 2),
            'transaction_ref' => $transaction_ref
        ]);
    } catch (Exception $e) {
        if (isset($db) && $db->getPdo()->inTransaction()) {
            $db->getPdo()->rollBack();
        }

        error_log("Add Money Error: " . $e->getMessage());

        http_response_code(500);
        echo json_encode([
            'success' => false,
            'message' => 'Transaction failed.  Please try again.',
            'error' => $e->getMessage()
        ]);
    }
} else {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request method'
    ]);
}
exit;
