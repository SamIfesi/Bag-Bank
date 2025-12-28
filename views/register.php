<?php
require_once __DIR__ . "/../includes/check_auth.php";
// Get errors from session and clear them
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
$old_input = isset($_SESSION['old_input']) ? $_SESSION['old_input'] : [];
unset($_SESSION['errors']);
unset($_SESSION['old_input']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="../public/favicon.svg" type="image/svg" />
    <link rel="stylesheet" href="../public/assets/css/style.css" />
    <title>D'Bag Bank - Register</title>
</head>

<body class="body">
    <main>
        <img src="../public/logo-stacked.svg" alt="" class="logo" />
        <div class="loader-container hide" id="loader">
            <div class="spinner"></div>
        </div>
        <form action="app/handlers/process_register.php" method="post" id="register-form">
            <!-- Email input form -->
            <div id="email-form">
                <i class="ti ti-chevron-left back" onclick="window.location.href='../index.php'"></i>
                <div class="form-group">
                    <i class="ti ti-mail icon"></i>
                    <input
                        type="text"
                        class="input-form"
                        id="email"
                        name="email"
                        placeholder="Enter email" />
                </div>
                <span class="error showMsg" id="email-error">
                    <?php foreach ($errors as $error): ?>
                        <?php echo htmlspecialchars($error); ?>
                    <?php endforeach; ?>
                </span>

                <button type="button" class="btn-submit continue" id="continueEmail">Continue</button>
                <p class="alt-login">
                    Already have an account? <a href="login.php">Login here</a>
                </p>
            </div>

            <!-- Fullname signup form -->
            <div id="name-form" class="hide">
                <i class="ti ti-chevron-left back" id="backEmail"></i>
                <div class="form-group">
                    <i class="ti ti-user-edit icon"></i>
                    <input
                        type="text"
                        class="input-form"
                        id="fullname"
                        name="name"
                        placeholder="Enter fullname" />
                </div>
                <span class="error" id="fullname-error"></span>
                <div class="form-group">
                    <i class="ti ti-user icon"></i>
                    <input
                        type="text"
                        class="input-form"
                        id="username"
                        name="username"
                        placeholder="Enter username" />
                </div>
                <span class="error" id="user-error"></span>
                <button type="button" class="btn-submit" id="continueName">Continue</button>
                <p class="alt-login">
                    Already have an account? <a href="login.php">Login here</a>
                </p>
            </div>

            <!-- Password signup form -->
            <div id="password-form" class="hide">
                <i class="ti ti-chevron-left back" id="backName"></i>
                <div class="form-group">
                    <i class="ti ti-eye icon" id="psdShow"></i>
                    <input
                        type="password"
                        class="input-form"
                        id="password"
                        name="password"
                        placeholder="Create your password" />
                </div>
                <div class="check-container">
                    <li class="psd-check">Minimum 8 characters</li>
                    <li class="psd-check">1 uppercase character</li>
                    <li class="psd-check">1 lowercase character</li>
                    <li class="psd-check">1 number character</li>
                    <li class="psd-check">Atleast 1 special character</li>
                    <span class="error" id="password-error"></span>
                </div>

                <button type="button" class="btn-submit" id="continuePassword">Continue</button>
                <p class="alt-login">
                    Already have an account? <a href="login.php">Login here</a>
                </p>
            </div>

            <!-- Confirm Password signup form -->
            <div id="confirm-Pswd-form" class="hide">
                <i class="ti ti-chevron-left back" id="backPsd"></i>
                <div class="form-group">
                    <i class="ti ti-eye icon" id="cfmPsdShow"></i>
                    <input
                        type="password"
                        class="input-form"
                        id="cfm-password"
                        name="confirm-password"
                        placeholder="Confirm password" />
                </div>
                <span class="error" id="cfm-psd-error"></span>

                <button type="submit" class="btn-submit" id="registerUser">Register</button>
                <p class="alt-login">
                    Already have an account? <a href="ogin.php">Login here</a>
                </p>
            </div>
        </form>
    </main>
    <span class="msg-success" id="msg-success"></span>
    <script type="module" src="../public/assets/js/main.js"></script>
</body>

</html>