<?php
session_start();
require_once "app/model/model.php";
require_once "config/functions/utilities.php";
require_once "app/controller/userController.php";


$userController = new userController();

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $required_fields = ['name', 'email', 'username', 'password', 'confirm-password'];

    $user_datas = $_POST;

    // checking for empty fields
    check_empty_fields($required_fields, $user_datas, $errors);

    if (count($errors) < 1) {
        $username = sanitize_input(trim($_POST['username']));
        $email = sanitize_input(trim($_POST['email']));
        $fullname = sanitize_input(trim($_POST['name']));
        $password = sanitize_input($_POST['password']);
        $confirmPassword = sanitize_input($_POST['confirm-password']);

        if (strlen($username) < 3) {
            $errors[] = "Invalid Username";
        }

        if ($userController->user_exist($username)) {
            $errors[] = "$username already exists, please choose another.";
        }
        if (!is_email($email)) {
            $errors[] = "Invalid email format";
        }
        if (!is_safe_password($password)) {
            $errors[] = "Password must be at least 8 characters long and include at least one letter, one number, and one special character.";
        }
        if (!is_match($password, $confirmPassword)) {
            $errors[] = "Passwords do not match.";
        }
    }

    if (count($errors) < 1) {
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
            $user_id = userController::get_user($user_data['username'])->id;
            $_SESSION['user'] = $user_id;
            // User created successfully
            header("Location: dashboard.php");
            exit();
        } else {
            $errors[] = "An error occurred while creating the account. Please try again.";
        }
    }
}
