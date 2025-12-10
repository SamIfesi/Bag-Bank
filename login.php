<?php
session_start();

// Get errors from session and clear them
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
unset($_SESSION['errors']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="" />
    <link rel="shortcut icon" href="public/favicon.svg" type="image/svg" />
    <link rel="stylesheet" href="src/style.css">
    <title>D'Bag Bank - Login</title>
</head>

<body class="body">
    <main>
        <img src="public/logo-stacked.svg" alt="" class="logo" />
        <div class="loader-container hide" id="loader">
            <div class="spinner"></div>
        </div>

        <form action="includes/components/process_login.php" method="post" id="login-form">
            <div id="userLogin-form">
                <div class="form-group">
                    <i class="ti ti-user icon"></i>
                    <input
                        type="text"
                        class="input-form"
                        id="username"
                        name="username"
                        placeholder="Enter username" />
                </div>
                <span class="error" id="user-error">
                    <?php foreach ($errors as $error): ?>
                        <?php echo htmlspecialchars($error); ?>
                    <?php endforeach; ?>
                </span>
                <button type="submit" class="btn-submit continue" id="continueLogin">Continue</button>
                <button type="button" id="register" class="btn-submit" onclick="window.location.href='register.php'">Register</button>
            </div>

            <!-- Password div -->
            <div id="pswdLogin-form" class="hide">
                <i class="ti ti-chevron-left back" id="backToLogin"></i>
                <div class="form-group">
                    <i class="ti ti-eye icon" id="psdShow"></i>
                    <input
                        type="password"
                        class="input-form"
                        id="password"
                        name="password"
                        placeholder="Enter password" />
                </div>
                <span class="error" id="password-error">
                    <?php foreach ($errors as $error): ?>
                        <?php echo htmlspecialchars($error); ?>
                    <?php endforeach; ?>
                </span>
                <button type="submit" class="btn-submit">Login</button>
                <p class="alt-login">
                    Don't have an account? <a href="register.php">Register here</a>
                </p>
            </div>

        </form>
    </main>
    <span class="msg-success" id="msg-success"></span>
    <script type="module" src="src/main.js"></script>
</body>

</html>