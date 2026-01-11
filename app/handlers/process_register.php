<?php
session_start();
require_once __DIR__ . "/../../config/functions/utilities.php";
require_once __DIR__ . "/../../app/controller/userController.php";

$userController = new userController();
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $required_fields = ['name', 'email', 'username', 'password', 'confirm-password'];
    $user_datas = $_POST;

    // Check for empty fields
    check_empty_fields($required_fields, $user_datas, $errors);

    // Validate and sanitize input if no empty fields
    if (count($errors) < 1) {
        $username = sanitize_input(trim($_POST['username']));
        $email = sanitize_input(trim($_POST['email']));
        $fullname = sanitize_input(trim($_POST['name']));
        $password = sanitize_input($_POST['password']);
        $confirmPassword = sanitize_input($_POST['confirm-password']);

        // Validate username length
        if (strlen($username) < 3) {
            $errors[] = "Invalid Username";
        }

        // Check if username already exists
        if ($userController->user_exist($username)) {
            $errors[] = "$username already exists, please choose another.";
        }

        // Validate email format
        if (!is_email($email)) {
            $errors[] = "Invalid email format";
        }

        // Validate password strength
        if (!is_safe_password($password)) {
            $errors[] = "Password must be at least 8 characters long and include at least one letter, one number, and one special character.";
        }

        // Check password match
        if (!is_match($password, $confirmPassword)) {
            $errors[] = "Passwords do not match.";
        }
    }

    // If there are validation errors, store them in session and redirect back
    if (count($errors) > 0) {
        $_SESSION['errors'] = $errors;
        $_SESSION['old_input'] = $_POST;
        header("Location: ../../views/register.php");
        exit();
    }

    // Create user if no validation errors
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $account_number = generate_account_number();

    $user_data = [
        'username' => $username,
        'email' => $email,
        'name' => $fullname,
        'password' => $hashed_password,
        'account_number' => $account_number,
    ];

    $create_user = $userController->create_user($user_data);

    if ($create_user) {
        $user = $userController->get_user($user_data['username']);
        if ($user) {
            $_SESSION['user'] = $user->id;
            unset($_SESSION['errors']);
            unset($_SESSION['old_input']);
            header("Location: ../../views/dashboard.php");
            exit();
        } else {
            $_SESSION['errors'] = ["User created but couldn't retrieve user data."];
            header("Location: ../../views/register.php");
            exit();
        }
    } else {
        $_SESSION['errors'] = ["An error occurred while creating the account. Please try again."];
        header("Location: ../../views/register.php");
        exit();
    }
}
