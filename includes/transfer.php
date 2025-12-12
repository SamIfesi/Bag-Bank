<?php
session_start();
require_once __DIR__ . "/config/functions/utilities.php";
require_once  __DIR__ . "/config/Auth.php";
require_once __DIR__ . "/includes/check_auth.php";

if (!is_logged_in()) {
    redirect_to("login.php");
    exit();
}
$user = Auth::user();
