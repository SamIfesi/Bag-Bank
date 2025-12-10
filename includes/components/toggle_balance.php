<?php
session_start();
if (!isset($_SESSION['show_balance'])) {
    $_SESSION['show_balance'] = true;
}
$_SESSION['show_balance'] = !$_SESSION['show_balance'];
echo json_encode(['show_balance' => $_SESSION['show_balance']]);