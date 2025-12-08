<?php

session_start();
require_once "config/functions/utilities.php";
require_once "config/Auth.php";
// if (!is_logged_in()) {
//     redirect_to("login.php");
//     exit();
// }
echo "Welcome to your dashboard!";
$user = Auth::user();
echo "Hello, " . htmlspecialchars($user->name) . "!";

