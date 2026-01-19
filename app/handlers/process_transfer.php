<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once __DIR__ . "/../model/model.php";
require_once __DIR__ . "/../../config/functions/utilities.php";
require_once __DIR__ . "/../../config/Auth.php";
require_once __DIR__ . "/../../includes/check_auth.php";

header('Content-Type: application/json');

if (!isset($_SESSION['user'])) {
    echo json_encode([
        'success' => false,
        'message' => 'User not logged in'
    ]);
    exit;
}

define('INTERNAL_BANK_CODE', 'my_bank');
$user_id = $_SESSION['user'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $amount = floatval($_POST['amount'] ?? 0);
    $recipient_acc = sanitize_input($_POST["recipient_account"] ?? '');
    $recipient_name = sanitize_input($_POST["recipient_name"] ?? '');
    $bank_code = sanitize_input($_POST["bank_code"] ?? '');

    // Validation
    if (empty($amount) || $amount <= 0 || !is_numeric($amount)) {
        echo json_encode([
            'success' => false,
            'message' => 'Invalid amount'
        ]);
        exit;
    }

    if ($amount < 100) {
        echo json_encode([
            'success' => false,
            'message' => 'Minimum transfer amount is 100'
        ]);
        exit;
    }

    if ($amount > 5000000) {
        echo json_encode([
            'success' => false,
            'message' => 'Amount exceeds transfer limit of 5,000,000'
        ]);
        exit;
    }

    // Get sender details
    $sender = Model::find('users', 'id', $user_id);

    if (!$sender) {
        echo json_encode([
            'success' => false,
            'message' => 'User not found'
        ]);
        exit;
    }

    // Convert both to strings and trim whitespace for comparison
    $recipient_acc_clean = trim((string)$recipient_acc);
    $sender_acc_clean = trim((string)$sender->account_number);

    if ($recipient_acc_clean === $sender_acc_clean) {
        echo json_encode([
            'success' => false,
            'message' => 'Cannot transfer to your own account'
        ]);
        exit;
    }

    if ($amount > $sender->balance) {
        echo json_encode([
            'success' => false,
            'message' => 'Insufficient balance'
        ]);
        exit;
    }

    try {
        $pdo = Model::pdo();
        $pdo->beginTransaction();

        $newSenderBalance = $sender->balance - $amount;
        $updateSender = Model::update('users', ['balance' => $newSenderBalance], $sender->id);

        if (!$updateSender) {
            $pdo->rollBack();
            echo json_encode(['success' => false, 'message' => 'Failed to update sender balance']);
            exit;
        }

        $transaction_ref = 'TXN' . time() . rand(1000, 9999);
        $debit_ref = $transaction_ref . '_D';

        $debitData = [
            'user_id' => $sender->id,
            'type' => 'debit',
            'amount' => $amount,
            'recipient_account' => $recipient_acc,
            'recipient_name' => $recipient_name,
            'bank_name' => $bank_code,
            'bank_code' => $bank_code,
            'description' => "Transfer to $recipient_name",
            'status' => 'success',
            'reference' => $debit_ref,
            'created_at' => date('Y-m-d H:i:s'),
        ];


        $debitTransaction = Model::create('transactions', $debitData);

        if (!$debitTransaction) {
            $pdo->rollBack();
            echo json_encode(['success' => false, 'message' => 'Failed to create transaction record']);
            exit;
        }

        if ($bank_code === INTERNAL_BANK_CODE) {
            $recipient = Model::find('users', 'account_number', $recipient_acc);

            if ($recipient) {
                $newRecipientBalance = $recipient->balance + $amount;
                $updateRecipient = Model::update('users', ['balance' => $newRecipientBalance], $recipient->id);

                if (!$updateRecipient) {
                    $pdo->rollBack();
                    echo json_encode(['success' => false, 'message' => 'Failed to update recipient balance']);
                    exit;
                }

                $credit_ref = $transaction_ref . '_C';

                $creditData = [
                    'user_id' => $recipient->id,
                    'type' => 'credit',
                    'amount' => $amount,
                    'sender_account' => $sender->account_number,
                    'sender_name' => $sender->name,
                    'bank_name' => "D'bag Bank",
                    'bank_code' => $bank_code,
                    'description' => "Transfer from {$sender->name}",
                    'status' => 'success',
                    'reference' => $credit_ref,
                    'created_at' => date('Y-m-d H:i:s'),
                ];

                $creditTransaction = Model::create('transactions', $creditData);

                if (!$creditTransaction) {
                    $pdo->rollBack();
                    echo json_encode(['success' => false, 'message' => 'Failed to create recipient transaction record']);
                    exit;
                }
            }
        }

        $pdo->commit();

        echo json_encode([
            'success' => true,
            'message' => 'Transfer successful',
            'transaction_ref' => $debit_ref
        ]);
    } catch (Exception $e) {
        if (isset($pdo) && $pdo->inTransaction()) {
            $pdo->rollBack();
        }

        error_log("Transfer Error: " . $e->getMessage());

        echo json_encode([
            'success' => false,
            'message' => 'Transfer failed. Please try again.',
            'error' => $e->getMessage(),
        ]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
exit;
