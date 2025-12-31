<section class="nav-section section <?= $hide_profile; ?>" data-name="profile">
    <header class="profile-header">
        <h2>My Profile</h2>
    </header>
    <div class="profile-container">
        <div class="profile-info">
            <button class="profile-btn">
                <i class="ti ti-user"></i>
                My profile
            </button>
            <button class="profile-btn">
                <i class="ti ti-settings"></i>
                Settings
            </button>
            <button class="profile-btn">
                <i class="ti ti-bell"></i>
                Notification
            </button>
            <button class="profile-btn" onclick="window.location.href='transactions.php'">
                <i class="ti ti-receipt"></i>
                Transaction History
            </button>
            <button class="profile-btn">
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