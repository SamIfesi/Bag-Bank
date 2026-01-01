<?php
session_start();
require_once __DIR__ . "/../../config/functions/utilities.php";
require_once __DIR__ . "/../../app/controller/userController.php";

$userController = new userController();
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? sanitize_input(trim($_POST['username'])) : '';
    $password = isset($_POST['password']) ? sanitize_input($_POST['password']) : '';

    // Validate username
    if (empty($username)) {
        $errors[] = "Username is required";
    }

    // Validate password
    if (empty($password)) {
        $errors[] = "Password is required";
    }

    // If no validation errors, proceed with login
    if (count($errors) < 1) {
        // Check if user exists
        $user = $userController->get_user($username);

        if ($user) {
            // Verify password
            if (password_verify($password, $user->password)) {
                // Login successful
                $_SESSION['user'] = $user->id;
                unset($_SESSION['errors']);
                header("Location: ../../views/dashboard.php");
                exit();
            } else {
                $errors[] = "Invalid username or password";
            }
        } else {
            $errors[] = "Invalid username or password";
        }
    }

    // Store errors in session and redirect back
    if (count($errors) > 0) {
        $_SESSION['errors'] = $errors;
        header("Location: ../../views/login.php");
        exit();
    }
}
