<?php
session_start();
require_once __DIR__ . "/../config/functions/utilities.php";
require_once __DIR__ . "/../config/Auth.php";
require_once __DIR__ . "/../includes/check_auth.php";

$user = Auth::user();

// Mock Data (Replace with DB fetch later)
$notifications = [
    ['id' => 1, 'type' => 'credit', 'title' => 'Credit Alert', 'msg' => '₦50,000.00 received from John Doe.', 'time' => 'Just now', 'is_read' => false],
    ['id' => 2, 'type' => 'security', 'title' => 'New Login', 'msg' => 'Login detected from iPhone 13.', 'time' => '2 hours ago', 'is_read' => false],
    ['id' => 3, 'type' => 'debit', 'title' => 'Debit Alert', 'msg' => '₦12,500.00 paid to DSTV Subscription.', 'time' => 'Yesterday', 'is_read' => true],
    ['id' => 4, 'type' => 'info', 'title' => 'System Maintenance', 'msg' => 'Scheduled maintenance on Sunday 2AM.', 'time' => '2 days ago', 'is_read' => true],
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications - D'Bag Bank</title>
    <link rel="stylesheet" href="../public/assets/css/notification.css">
    <link rel="shortcut icon" href="../public/favicon.svg" type="image/svg+xml">
</head>

<body>

    <!-- Header -->
    <header class="page-header">
        <div class="header-content">
            <button class="back-btn" onclick="history.back()">
                <i class="ti ti-chevron-left"></i>
            </button>
            <h1>Notifications</h1>
            <div class="header-actions">
                <button class="mark-read-btn" id="markAllRead" title="Mark all as read">
                    <i class="ti ti-checks"></i>
                </button>
            </div>
        </div>

        <!-- Filter Tabs -->
        <div class="filter-tabs">
            <button class="tab-btn active" data-filter="all">All</button>
            <button class="tab-btn" data-filter="unread">Unread</button>
            <button class="tab-btn" data-filter="transaction">Transactions</button>
            <button class="tab-btn" data-filter="security">Security</button>
        </div>
    </header>

    <!-- Main List -->
    <main class="notification-container">
        <div class="notification-list" id="notifList">
            <?php foreach ($notifications as $notif): ?>

                <!-- Determine Category for JS Filter -->
                <?php
                $category = ($notif['type'] == 'credit' || $notif['type'] == 'debit') ? 'transaction' : $notif['type'];
                ?>

                <div class="notif-item <?= $notif['is_read'] ? '' : 'unread' ?>"
                    data-category="<?= $category ?>"
                    data-id="<?= $notif['id'] ?>">

                    <!-- Icon Box -->
                    <div class="notif-icon-box <?= $notif['type'] ?>">
                        <?php if ($notif['type'] == 'credit'): ?>
                            <i class="ti ti-arrow-down-left"></i>
                        <?php elseif ($notif['type'] == 'debit'): ?>
                            <i class="ti ti-arrow-up-right"></i>
                        <?php elseif ($notif['type'] == 'security'): ?>
                            <i class="ti ti-shield-lock"></i>
                        <?php else: ?>
                            <i class="ti ti-info-circle"></i>
                        <?php endif; ?>
                    </div>

                    <!-- Content -->
                    <div class="notif-content">
                        <div class="notif-top">
                            <span class="notif-title"><?= htmlspecialchars($notif['title']) ?></span>
                            <span class="notif-time"><?= htmlspecialchars($notif['time']) ?></span>
                        </div>
                        <p class="notif-message"><?= htmlspecialchars($notif['msg']) ?></p>
                    </div>

                    <!-- Unread Dot -->
                    <?php if (!$notif['is_read']): ?>
                        <div class="status-dot"></div>
                    <?php endif; ?>
                </div>

            <?php endforeach; ?>

            <!-- Empty State -->
            <div class="empty-state hide">
                <div class="empty-icon">
                    <i class="ti ti-bell-off"></i>
                </div>
                <h3>No Notifications</h3>
                <p>You have no notifications in this category.</p>
            </div>
        </div>
    </main>

    <!-- Confirmation Modal -->
    <div class="confirmation-modal hide" id="confirmationModal">
        <div class="modal-overlay" id="modalOverlay"></div>
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modalTitle">Confirm Action</h3>
                <button class="modal-close" id="modalClose">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <p id="modalMessage">Are you sure you want to proceed?</p>
            </div>
            <div class="modal-footer">
                <button class="modal-btn cancel" id="modalCancel">Cancel</button>
                <button class="modal-btn confirm" id="modalConfirm">Confirm</button>
            </div>
        </div>
    </div>

    <script src="../public/assets/js/notification.js"></script>
</body>

</html>