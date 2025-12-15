<?php
require_once "../../app/controller/userController.php";
require_once "../../config/functions/utilities.php";

header('Content-Type: application/json');
const my_bank = "my_bank";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $account_number = sanitize_input($_POST['account_number'] ?? '');
    $bank_code = sanitize_input($_POST['bank_code'] ?? '');

    if (empty($account_number)) {
        echo json_encode(['success' => false, 'message' => 'Account number required']);
        exit;
    }
    if ($bank_code !== my_bank) {
        echo json_encode(['success' => false, 'message' => 'Amount not found in selected bank']);
        exit;
    }
    $user = Model::find('users', 'account_number', $account_number);

    if ($user) {
        echo json_encode([
            'success' => true,
            'name' => $user->name
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Account number not found'
        ]);
    }
}
