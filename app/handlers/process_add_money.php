<?php
ini_set('display_errors', 0);
error_reporting(E_ALL);

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

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(405);
  echo json_encode(['success' => false, 'message' => 'Invalid request method']);
  exit;
}

$input = json_decode(file_get_contents('php://input'), true);

if (!is_array($input)) {
  http_response_code(400);
  echo json_encode(['success' => false, 'message' => 'Invalid request body']);
  exit;
}

$amount = isset($input['amount']) ? floatval($input['amount']) : 0;
$payment_method = isset($input['payment_method']) ? sanitize_input($input['payment_method']) : '';
$description = isset($input['description']) ? sanitize_input($input['description']) : 'Wallet top-up';


$allowed_methods = ['card', 'bank', 'ussd'];

if ($amount <= 0 || !is_numeric($input['amount'] ?? '')) {
  http_response_code(400);
  echo json_encode(['success' => false, 'message' => 'Invalid amount']);
  exit;
}

if ($amount < 100) {
  http_response_code(400);
  echo json_encode(['success' => false, 'message' => 'Minimum amount is ₦100.00']);
  exit;
}

if ($amount > 10000) {
  http_response_code(400);
  echo json_encode(['success' => false, 'message' => 'Maximum amount is ₦10,000.00 per transaction']);
  exit;
}

if (empty($payment_method) || !in_array($payment_method, $allowed_methods, true)) {
  http_response_code(400);
  echo json_encode(['success' => false, 'message' => 'Invalid payment method']);
  exit;
}

$user_id = $_SESSION['user'];
$user = Model::find('users', 'id', $user_id);

if (!$user) {
  http_response_code(404);
  echo json_encode([
    'success' => false,
    'message' => 'User not found'
  ]);
  exit;
}

$pdo = Model::pdo();

try {
  $pdo->beginTransaction();

  // 1. Credit the user's balance
  $new_balance   = $user->balance + $amount;
  $balance_saved = Model::update('users', ['balance' => $new_balance], $user->id);

  if (!$balance_saved) {
    throw new RuntimeException('Failed to update balance');
  }

  // 2. Record the transaction
  $transaction_ref = 'ADD' . time() . rand(1000, 9999);

  $transaction_id = Model::create('transactions', [
    'user_id'          => $user->id,
    'type'             => 'top_up',
    'amount'           => $amount,
    'recipient_name'   => null,
    'recipient_account' => null,
    'sender_account'   => $payment_method,
    'sender_name'      => ucfirst($payment_method) . ' Payment',
    'bank_name'        => "D'bag Bank",
    'bank_code'        => 'add_money',
    'description'      => $description,
    'status'           => 'success',
    'reference'        => $transaction_ref,
    'created_at'       => date('Y-m-d H:i:s'),
  ]);

  if (!$transaction_id) {
    throw new RuntimeException('Failed to create transaction record');
  }

  // Both steps succeeded — commit
  $pdo->commit();

  http_response_code(200);
  echo json_encode([
    'success'         => true,
    'message'         => 'Money added successfully',
    'new_balance'     => number_format($new_balance, 2),
    'amount_added'    => number_format($amount, 2),
    'transaction_ref' => $transaction_ref,
  ]);
} catch (Throwable $e) {
  // Roll back whatever succeeded so the DB stays consistent
  if ($pdo->inTransaction()) {
    $pdo->rollBack();
  }

  error_log('Add Money Error [user=' . $user_id . ']: ' . $e->getMessage());

  http_response_code(500);
  echo json_encode([
    'success' => false,
    'message' => 'Transaction failed. Please try again.',
  ]);
}
exit;
