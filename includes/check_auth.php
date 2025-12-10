<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$public_pages = [
    'index.php',
    'login.php',
    'register.php'
];

function check_auth($public_pages)
{
    $isAuthenticated = isset($_SESSION['user']) && !empty($_SESSION['user']);
    $currentPage = basename($_SERVER['PHP_SELF']);

    $isPublicPage = in_array($currentPage, $public_pages);

    // --- Redirection Logic ---

    if (!$isAuthenticated && !$isPublicPage) {
        header("Location: login.php");
        exit();
    }
    if ($isAuthenticated && $isPublicPage) {
        header("Location: dashboard.php");
        exit();
    }
}
check_auth($public_pages);
