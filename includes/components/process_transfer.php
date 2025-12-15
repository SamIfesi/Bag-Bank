<?php
session_start();
require_once __DIR__ . "/../../app/model/model.php";
require_once __DIR__ . "/../../app/controller/userController.php"; 
require_once __DIR__ . "/../../config/functions/utilities.php"; 

header('Content-Type: application/json');

if (!isset($_SESSION['user'])) {
    echo json_encode(
        [
            'success' => false,
            'message' => 'User not logged in'
        ]
    );
    exit;
}

const internal_bank_code = "my_bank";
$user_id = $_SESSION['user'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $amount = floatval($_POST['amount'] ?? 0);
    $recipient_acc = sanitize_input($_POST["recipient_account"] ?? '');
    $recipient_name = sanitize_input($_POST["recipient_name"] ?? '');
    $bank_code = sanitize_input($_POST["bank_code"] ?? '');

    if (empty($amount) || $amount <= 0 || !is_numeric($amount) || $amount < 100) {
        echo json_encode(['success' => false, 'message' => 'Invalid amount']);
        exit;
    } else if ($amount > 5000000) {
        echo json_encode(['success' => false, 'message' => 'Amount exceeds transfer limit of 5,000,000']);
        exit;
    } else if ($amount < 100) {
        echo json_encode(['success' => false, 'message' => 'Minimum transfer amount is 100']);
        exit;
    }
    $sender = Model::find('users', 'id', $user_id);

    if (!$sender) {
        echo json_encode(['success' => false, 'message' => 'User not found']);
        exit;
    }
    if ($amount > $sender->balance) {
        echo json_encode(['success' => false, 'message' => 'Insufficient balance']);
        exit;
    }
    $db = new Database();
    $newSenderBalance = $sender->balance - $amount;
    $updateSender = Model::update('users', ['balance' => $newSenderBalance], $sender->id);

    if ($updateSender) {
        $debitData = [
            'user_id' => $sender->id,
            'type' => 'debit',
            'amount' => $amount,
            'recipient_account' => $recipient_acc,
            'recipient_name' => $recipient_name,
            'bank_code' => $bank_code,
            'description' => "Transfer to  $recipient_name",
            'status' => 'success',
            'timestamp' => date('Y-m-d H:i:s'),
        ];
        Model::create('transactions', $debitData);
        if ($bank_code === internal_bank_code) {
            $recipient = Model::find('users', 'account_number', $recipient_acc);
            if ($recipient) {
                $newRecipientBalance = $recipient->balance + $amount;
                Model::update('users', ['balance' => $newRecipientBalance], $recipient->id);
                $creditData = [
                    'user_id' => $recipient->id,
                    'type' => 'credit',
                    'amount' => $amount,
                    'sender_account' => $sender->account_number,
                    'sender_name' => $sender->name,
                    'bank_code' => $bank_code,
                    'description' => "Transfer from  {$sender->name}",
                    'status' => 'success',
                    'timestamp' => date('Y-m-d H:i:s'),
                ];
                Model::create('transactions', $creditData);
            }
        }
        echo json_encode(['success' => true, 'message' => 'Transfer successful']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Transfer failed, please try again']);
    };
}
