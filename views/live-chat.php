<?php
session_start();
require_once __DIR__ . "/../config/functions/utilities.php";
require_once  __DIR__ . "/../config/Auth.php";
require_once __DIR__ . "/../includes/check_auth.php";

if (!is_logged_in()) {
  redirect_to("login.php");
  exit();
}
$user = Auth::user();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="../public/favicon.svg" type="image/svg" />
    <link rel="stylesheet" href="../public/assets/css/live-chat.css">
    <title>Live Chat - D'Bag Bank Support</title>
</head>

<body class="chat-body">
    <!-- Chat Header -->
    <header class="chat-header">
        <div class="header-left">
            <button class="back-btn" onclick="window.location.href='dashboard.php'">
                <i class="ti ti-chevron-left"></i>
            </button>
            <div class="agent-info">
                <div class="agent-avatar">
                    <div class="avatar-img">
                        <i class="ti ti-robot"></i>
                    </div>
                    <span class="status-indicator online"></span>
                </div>
                <div class="agent-details">
                    <h3>D'Bag Assistant</h3>
                    <p class="status-text">Online • AI Powered</p>
                </div>
            </div>
        </div>
        <div class="header-actions">
            <button class="header-btn" id="clearChatBtn" title="Clear Chat">
                <i class="ti ti-trash"></i>
            </button>
            <button class="header-btn" id="menuBtn" title="Menu">
                <i class="ti ti-dots-vertical"></i>
            </button>
        </div>
    </header>

    <!-- Chat Messages Container -->
    <main class="chat-messages" id="chatMessages">
        <!-- Welcome Message -->
        <div class="message-group bot">
            <div class="message-avatar">
                <i class="ti ti-robot"></i>
            </div>
            <div class="message-wrapper">
                <div class="message bot">
                    <div class="message-content">
                        <p>👋 Hello <?= htmlspecialchars($user->name) ?>! I'm your D'Bag Bank AI Assistant. </p>
                        <p>How can I help you today? </p>
                    </div>
                    <span class="message-time"><?= date('g:i A') ?></span>
                </div>
            </div>
        </div>

        <!-- Suggested Actions -->
        <div class="suggested-actions" id="suggestedActions">
            <button class="suggestion-chip" data-message="Check my account balance">
                <i class="ti ti-wallet"></i>
                Check Balance
            </button>
            <button class="suggestion-chip" data-message="How do I transfer money? ">
                <i class="ti ti-send"></i>
                Transfer Help
            </button>
            <button class="suggestion-chip" data-message="Tell me about my account">
                <i class="ti ti-user"></i>
                Account Info
            </button>
            <button class="suggestion-chip" data-message="What are your fees?">
                <i class="ti ti-receipt"></i>
                Fees & Charges
            </button>
        </div>

        <!-- Typing Indicator (hidden by default) -->
        <div class="typing-indicator hide" id="typingIndicator">
            <div class="message-avatar">
                <i class="ti ti-robot"></i>
            </div>
            <div class="typing-dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </main>

    <!-- Chat Input -->
    <footer class="chat-input-container">
        <form class="chat-input-form" id="chatForm">
            <button type="button" class="attach-btn" id="attachBtn">
                <i class="ti ti-paperclip"></i>
            </button>
            <div class="input-wrapper">
                <textarea 
                    id="messageInput" 
                    placeholder="Type your message..." 
                    rows="1"
                    maxlength="1000"></textarea>
                <span class="char-counter" id="charCounter">0/1000</span>
            </div>
            <button type="submit" class="send-btn" id="sendBtn" disabled>
                <i class="ti ti-send"></i>
            </button>
        </form>
    </footer>

    <!-- Quick Actions Menu (Hidden) -->
    <div class="quick-menu hide" id="quickMenu">
        <div class="menu-overlay" id="menuOverlay"></div>
        <div class="menu-content">
            <h4>Quick Actions</h4>
            <button class="menu-item" data-action="export">
                <i class="ti ti-download"></i>
                Export Chat
            </button>
            <button class="menu-item" data-action="feedback">
                <i class="ti ti-star"></i>
                Send Feedback
            </button>
            <button class="menu-item" data-action="help">
                <i class="ti ti-help"></i>
                Help & FAQs
            </button>
            <button class="menu-item danger" data-action="clear">
                <i class="ti ti-trash"></i>
                Clear All Messages
            </button>
        </div>
    </div>

    <!-- User Info (for AI context) -->
    <script>
        const USER_DATA = {
            name: "<?= htmlspecialchars($user->name) ?>",
            email: "<?= htmlspecialchars($user->email) ?>",
            account_number: "<?= htmlspecialchars($user->account_number) ?>",
            balance: "<?= number_format($user->balance, 2) ?>",
            member_since: "<?= date('F Y', strtotime($user->created_at)) ?>"
        };
    </script>

    <script src="../public/assets/js/live-chat.js"></script>
</body>

</html>