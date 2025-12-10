<?php
session_start();
require_once "config/functions/utilities.php";
require_once "config/Auth.php";

if (!is_logged_in()) {
    redirect_to("login.php");
    exit();
}
$user = Auth::user();
require_once __DIR__ . "/includes/layout/app_header.php";
require_once __DIR__ . "/includes/layout/app_card.php";
require_once __DIR__ . "/includes/layout/app_footer.php";
