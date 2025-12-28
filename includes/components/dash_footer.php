<nav class="bottom-nav">
    <a href="#" class="nav-item active" data-page="home">
        <i class="ti ti-home"></i>
        <span>Home</span>
    </a>
    <a href="#" class="nav-item" data-page="transactions">
        <i class="ti ti-logs"></i>
        <span>Activity</span>
    </a>
    <a href="#" class="nav-item show-card" data-page="card">
        <i class="ti ti-credit-card"></i>
        <span>Card</span>
    </a>
    <a href="#" class="nav-item" data-page="profile">
        <i class="ti ti-user"></i>
        <span>Profile</span>
    </a>
</nav>

<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="sidebar-logo">
            <img src="public/logo-icon.svg" alt="D'Bag Bank" class="logo-icon">
            <span class="logo-text">D'Bag Bank</span>
        </div>
    </div>

    <nav class="sidebar-nav">
        <a href="views/dashboard.php" class="sidebar-item active">
            <i class="ti ti-home"></i>
            <span>Home</span>
        </a>
        <a href="views/send.php" class="sidebar-item">
            <i class="ti ti-send"></i>
            <span>Send Money</span>
        </a>
        <a href="views/transactions.php" class="sidebar-item">
            <i class="ti ti-logs"></i>
            <span>Transactions</span>
        </a>
        <a href="#" class="sidebar-item show-card" data-page="card">
            <i class="ti ti-credit-card"></i>
            <span>Cards</span>
        </a>
        <a href="#" class="sidebar-item">
            <i class="ti ti-settings"></i>
            <span>Settings</span>
        </a>
    </nav>

    <div class="sidebar-footer">

        <button class="sidebar-toggle" id="sidebarToggle" aria-label="Toggle Sidebar">
            <i class="ti ti-layout-sidebar-left-collapse" id="collapse-icon"></i>
            <span>Collapse</span>
        </button>
        <a href="logout.php" class="sidebar-item logout">
            <i class="ti ti-logout"></i>
            <span>Logout</span>
        </a>
    </div>
</aside>
<script src="public/assets/js/dash.js"></script>
</body>

</html>