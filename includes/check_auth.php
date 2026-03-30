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

function app_base_path(): string
{
    $projectRoot = realpath(dirname(__DIR__));
    $documentRoot = isset($_SERVER['DOCUMENT_ROOT']) ? realpath($_SERVER['DOCUMENT_ROOT']) : false;

    if ($projectRoot !== false && $documentRoot !== false) {
        $normalizedProjectRoot = str_replace('\\', '/', $projectRoot);
        $normalizedDocumentRoot = str_replace('\\', '/', $documentRoot);

        if (strpos($normalizedProjectRoot, $normalizedDocumentRoot) === 0) {
            $relativePath = trim(substr($normalizedProjectRoot, strlen($normalizedDocumentRoot)), '/');
            return $relativePath === '' ? '' : '/' . $relativePath;
        }
    }

    return '';
}

function check_auth(array $public_pages): void
{
    $isAuthenticated = isset($_SESSION['user']) && !empty($_SESSION['user']);
    $currentPage     = basename($_SERVER['PHP_SELF']);
    $isPublicPage    = in_array($currentPage, $public_pages, true);

    if (!$isAuthenticated && !$isPublicPage) {
        header('Location: ' . app_base_path() . '/views/login.php');
        exit;
    }

    if ($isAuthenticated && $isPublicPage) {
        header('Location: ' . app_base_path() . '/views/dashboard.php');
        exit;
    }
}

check_auth($public_pages);