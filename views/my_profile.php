<?php
session_start();
require_once __DIR__ . "/../config/functions/utilities.php";
require_once  __DIR__ . "/../config/Auth.php";
require_once __DIR__ . "/../includes/check_auth.php";

if (! is_logged_in()) {
  redirect_to("login.php");
  exit();
}
$user= Auth::user();

// Get success/error messages from session
$success_msg= isset($_SESSION['success_msg']) ? $_SESSION['success_msg'] : '';
$error_msg= isset($_SESSION['error_msg']) ? $_SESSION['error_msg'] : '';
unset($_SESSION['success_msg']);
unset($_SESSION['error_msg']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="../public/favicon.svg" type="image/svg" />
    <link rel="stylesheet" href="../public/assets/css/profile.css">
    <title>My Profile - D'Bag Bank</title>
</head>

<body class="profile-body">
    <!-- Loader -->
    <div class="loader-container hide" id="loader">
        <div class="loader">
            <div class="spinner"></div>
        </div>
    </div>

    <!-- Error Banner -->
    <div class="error-banner" id="errorBanner">
        <div class="error-banner-content">
            <i class="ti ti-alert-circle"></i>
            <span id="errorMessage"></span>
            <button type="button" class="error-banner-close" onclick="this.parentElement.parentElement.classList.remove('show')">
                <i class="ti ti-x"></i>
            </button>
        </div>
    </div>

    <!-- Header -->
    <header class="profile-header">
        <button class="back-btn" onclick="window.location.href='dashboard.php'">
            <i class="ti ti-chevron-left"></i>
        </button>
        <h2>My Profile</h2>
        <span></span>
    </header>

    <!-- Success/Error Messages -->
    <?php if ($success_msg): ?>
        <div class="alert alert-success" id="successAlert">
            <i class="ti ti-check-circle"></i>
            <span><?= htmlspecialchars($success_msg) ?></span>
        </div>
    <?php endif; ?>

    <?php if ($error_msg): ?>
        <div class="alert alert-error" id="errorAlert">
            <i class="ti ti-alert-circle"></i>
            <span><?= htmlspecialchars($error_msg) ?></span>
        </div>
    <?php endif; ?>

    <main class="profile-container">
        <form class="profile-form" id="profileForm" method="POST" enctype="multipart/form-data" action="../app/handlers/process_profile_update.php">
            <!-- Profile Picture Section -->
            <section class="profile-picture-section">
                <div class="profile-picture-container">
                    <div class="profile-picture">
                        <?php if (!empty($user->user_image)): ?>
                            <img src="../<?= htmlspecialchars($user->user_image) ?>" alt="Profile Picture" id="profileImage">
                        <?php else: ?>
                            <div class="default-avatar">
                                <i class="ti ti-user"></i>
                            </div>
                        <?php endif; ?>
                        <label for="imageUpload" class="image-upload-label">
                            <i class="ti ti-camera"></i>
                        </label>
                        <input type="file" id="imageUpload" name="user_image" accept="image/*" hidden>
                    </div>
                    <div class="profile-name">
                        <h3><?= htmlspecialchars($user->name) ?></h3>
                        <p><?= htmlspecialchars($user->email) ?></p>
                    </div>
                </div>
            </section>

            <!-- Basic Details -->
            <section class="form-section">
                <h3 class="section-title">
                    <i class="ti ti-user-circle"></i>
                    Basic Details
                </h3>

                <div class="form-group">
                    <label for="fullname">Full Name</label>
                    <input 
                        type="text" 
                        id="fullname" 
                        name="name" 
                        value="<?= htmlspecialchars($user->name) ?>" 
                        class="form-input"
                        disabled
                        readonly>
                    <span class="input-note">Contact support to change your name</span>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="<?= htmlspecialchars($user->email) ?>" 
                        class="form-input"
                        disabled
                        readonly>
                    <span class="input-note">Contact support to change your email</span>
                </div>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input 
                        type="text" 
                        id="username" 
                        name="username" 
                        value="<?= htmlspecialchars($user->username) ?>" 
                        class="form-input"
                        disabled
                        readonly>
                </div>

                <div class="form-group">
                    <label for="dob">Date of Birth</label>
                    <input 
                        type="date" 
                        id="dob" 
                        name="date_of_birth" 
                        value="<?= htmlspecialchars($user->date_of_birth ??  '') ?>" 
                        class="form-input"
                        max="<?= date('Y-m-d', strtotime('-18 years')) ?>">
                </div>

                <div class="form-group">
                    <label>Gender</label>
                    <div class="radio-group">
                        <label class="radio-option">
                            <input 
                                type="radio" 
                                name="gender" 
                                value="male" 
                                <?= (isset($user->gender) && $user->gender=== 'male') ? 'checked' : '' ?>>
                            <span class="radio-label">
                                <i class="ti ti-user"></i>
                                Male
                            </span>
                        </label>
                        <label class="radio-option">
                            <input 
                                type="radio" 
                                name="gender" 
                                value="female" 
                                <?= (isset($user->gender) && $user->gender=== 'female') ? 'checked' : '' ?>>
                            <span class="radio-label">
                                <i class="ti ti-user"></i>
                                Female
                            </span>
                        </label>
                    </div>
                </div>
            </section>

            <!-- Contact Details -->
            <section class="form-section">
                <h3 class="section-title">
                    <i class="ti ti-phone"></i>
                    Contact Details
                </h3>

                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input 
                        type="tel" 
                        id="phone" 
                        name="phone_number" 
                        value="<?= htmlspecialchars($user->phone_number ??  '') ?>" 
                        placeholder="+234 800 000 0000"
                        class="form-input"
                        maxlength="15">
                    <span class="error" id="phone-error"></span>
                </div>

                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea 
                        id="address" 
                        name="address" 
                        rows="3" 
                        placeholder="Enter your address"
                        class="form-textarea"><?= htmlspecialchars($user->address ?? '') ?></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="city">City</label>
                        <input 
                            type="text" 
                            id="city" 
                            name="city" 
                            value="<?= htmlspecialchars($user->city ??  '') ?>" 
                            placeholder="e.g., Lagos"
                            class="form-input">
                    </div>

                    <div class="form-group">
                        <label for="state">State</label>
                        <input 
                            type="text" 
                            id="state" 
                            name="state" 
                            value="<?= htmlspecialchars($user->state ?? '') ?>" 
                            placeholder="e.g., Lagos State"
                            class="form-input">
                    </div>
                </div>
            </section>

            <!-- Additional Information (NEW) -->
            <section class="form-section">
                <h3 class="section-title">
                    <i class="ti ti-info-circle"></i>
                    Additional Information
                </h3>

                <div class="form-group">
                    <label for="occupation">Occupation</label>
                    <input 
                        type="text" 
                        id="occupation" 
                        name="occupation" 
                        value="<?= htmlspecialchars($user->occupation ?? '') ?>" 
                        placeholder="e.g., Software Developer"
                        class="form-input">
                </div>

                <div class="form-group">
                    <label for="bio">Bio</label>
                    <textarea 
                        id="bio" 
                        name="bio" 
                        rows="4" 
                        placeholder="Tell us about yourself..."
                        maxlength="500"
                        class="form-textarea"><?= htmlspecialchars($user->bio ?? '') ?></textarea>
                    <span class="char-count"><span id="bioCount">0</span>/500</span>
                </div>
            </section>

            <!-- Security Settings (Read-only) -->
            <section class="form-section">
                <h3 class="section-title">
                    <i class="ti ti-shield-lock"></i>
                    Security
                </h3>

                <div class="info-card">
                    <div class="info-item">
                        <span class="info-label">Account Number</span>
                        <span class="info-value"><?= htmlspecialchars($user->account_number) ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Member Since</span>
                        <span class="info-value"><?= date('F Y', strtotime($user->created_at)) ?></span>
                    </div>
                </div>

                <button type="button" class="btn-secondary" onclick="window.location.href='change-password.php'">
                    <i class="ti ti-lock"></i>
                    Change Password
                </button>
            </section>

            <!-- Save Button -->
            <div class="form-actions">
                <button type="submit" class="btn-save" id="saveBtn">
                    <i class="ti ti-check"></i>
                    Save Changes
                </button>
            </div>
        </form>
    </main>

    <script src="../public/assets/js/profile.js"></script>
</body>

</html>