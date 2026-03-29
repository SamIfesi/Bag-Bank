<?php

require_once __DIR__ . "/../core/Session.php";

Session::start();

$public_pages = [
    'index.php',
    'login.php',
    'register.php',
    'about_us.php',
    'blog.php',
    'careers.php',
    'press.php',
    'pricing.php',
    'help-center.php',
    'contact.php',
    'privacy-policy.php',
    'terms-of-service.php',
];

function check_auth(array $public_pages): void
{
    $isAuthenticated = isset($_SESSION['user']) && !empty($_SESSION['user']);
    $currentPage     = basename($_SERVER['PHP_SELF']);
    $isPublicPage    = in_array($currentPage, $public_pages, true);

    if (!$isAuthenticated && !$isPublicPage) {
        header('Location: /views/login.php');
        exit;
    }

    if ($isAuthenticated && $isPublicPage) {
        header('Location: /views/dashboard.php');
        exit;
    }
}

check_auth($public_pages);