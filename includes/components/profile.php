<section class="nav-section section <?= $hide_profile; ?>" data-name="profile">
    <header class="profile-header">
        <h2>Profile</h2>
    </header>
    <div class="profile-header-content">
        <img src="<?= $user->user_image ? '../' . htmlspecialchars($user->user_image) : '../public/avatar.svg'; ?>" alt="Profile" class="profile-avatar">
        <div class="profile-details">
            <h3><?= htmlspecialchars(ucfirst($user->username ?? 'User')); ?></h3>
            <p><?= htmlspecialchars($user->email ?? 'email@example.com'); ?></p>
        </div>
    </div>
    <div class="profile-container">
        <div class="profile-info">
            <button class="profile-btn" onclick="window.location.href='my_profile.php'">
                <i class="ti ti-user"></i>
                My profile
            </button>
            <button class="profile-btn">
                <i class="ti ti-settings"></i>
                Settings
            </button>
            <button class="profile-btn" onclick="window.location.href='notification.php'">
                <i class="ti ti-bell"></i>
                Notification
            </button>
            <button class="profile-btn" onclick="window.location.href='live-chat.php'">
                <i class="ti ti-bubble-text"></i>
                Live Support
            </button>
            <button class="profile-btn" onclick="window.location.href='faq.php'">
                <i class="ti ti-help-circle"></i>
                FAQ
            </button>
            <button class="profile-btn">
                <i class="ti ti-info-circle"></i>
                About App
            </button>
        </div>
        <button class="profile-btn logout-btn" onclick="window.location.href='../logout.php'">
            <i class="ti ti-logout"></i>
            Logout
        </button>
    </div>
</section>