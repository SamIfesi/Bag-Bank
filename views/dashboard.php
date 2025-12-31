<?php
session_start();
require_once __DIR__ . "/../config/functions/utilities.php";
require_once  __DIR__ . "/../config/Auth.php";
require_once __DIR__ . "/../includes/check_auth.php";

if (!is_logged_in()) {
    redirect_to("login.php");
    exit();
}

$current_page = isset($_SESSION['current_page']) ? $_SESSION['current_page'] : 'home';
$hide_home = ($current_page !== 'home') ? 'hide' : '';
$hide_card = ($current_page !== 'card') ? 'hide' : '';
$hide_profile = ($current_page !== 'profile') ? 'hide' : '';
$hide_transactions = ($current_page !== 'transactions') ? 'hide' : '';

$user = Auth::user();

$db = new Database();
$stmt = $db->getPdo()->prepare("SELECT * FROM transactions WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$user->id]);
$all_transactions = $stmt->fetchAll();


require_once __DIR__ . "/../includes/components/dash_header.php";
require_once __DIR__ . "/../includes/components/dash_main.php";
require_once __DIR__ . "/../includes/components/atm_card.php";
require_once __DIR__ . "/../includes/components/profile.php";
require_once __DIR__ . "/../includes/components/activity.php";
require_once __DIR__ . "/../includes/components/dash_footer.php";
