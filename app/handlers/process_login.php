<?php

require_once __DIR__ . "/../../core/Config.php";
require_once __DIR__ . "/../../core/Session.php";
require_once ROOT . "/config/functions/utilities.php";
require_once ROOT . "/app/controller/userController.php";

Session::start(); // also resets $_SESSION['last_activity']

$userController = new userController();
$errors         = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $username = isset($_POST['username']) ? sanitize_input(trim($_POST['username'])) : '';
  $password = isset($_POST['password']) ? $_POST['password'] : '';

  if (empty($username)) {
    $errors[] = 'Username is required';
  }

  if (empty($password)) {
    $errors[] = 'Password is required';
  }

  if (empty($errors)) {
    $user = $userController->get_user($username);

    if ($user && password_verify($password, $user->password)) {
      session_regenerate_id(true);

      $_SESSION['user'] = $user->id;
      $_SESSION['last_activity'] = time();   // initialise inactivity timer
      unset($_SESSION['errors']);
      
      header('Location: /views/dashboard.php');
      exit;
    }

    $errors[] = 'Invalid username or password';
  }

  $_SESSION['errors'] = $errors;

  header('Location: /views/login.php');
  exit;
}
