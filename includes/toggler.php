<?php
session_start();

$valid_items = ['balance', 'account_number', 'card'];
$item_key = isset($_GET['item']) ? $_GET['item'] : '';

if (empty($item_key) || !in_array($item_key, $valid_items)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid or missing item key.']);
    exit();
}

$session_var = 'show_' . ($item_key === 'card' ? 'full_card' : $item_key);
if (!isset($_SESSION[$session_var])) {
    $_SESSION[$session_var] = ($item_key === 'balance');
}
$_SESSION[$session_var] = !$_SESSION[$session_var];

header('Content-Type: application/json');
echo json_encode(['success' => true, 'item' => $item_key, 'state' => $_SESSION[$session_var]]);
exit();
?>