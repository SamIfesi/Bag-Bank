<?php
require_once __DIR__ . "/dash_card.php";
require_once __DIR__ . "/dash_trans.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="" />
    <link rel="shortcut icon" href="../public/favicon.svg" type="image/svg" />
    <link rel="stylesheet" href="../public/assets/css/dash.css">
    <link rel="stylesheet" href="../public/assets/css/activity.css">
    <title>D'Bag Bank - Dashboard</title>
</head>

<body class="home-body" data-current-page="<?= isset($_SESSION['current_page']) ? htmlspecialchars($_SESSION['current_page']) : 'home'; ?>">