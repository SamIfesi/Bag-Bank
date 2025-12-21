<?php require_once __DIR__ . "/includes/check_auth.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="public/favicon.svg" type="image/svg" />
    <link rel="stylesheet" href="public/assets/css/index.css">
    <link rel="stylesheet" href="public/assets/css/support-pages.css">
    <title>Help Center - D'Bag Bank</title>
</head>

<body class="page-body">
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-logo">
                <a href="index. php">
                    <img src="public/logo.svg" alt="D'Bag Bank" />
                </a>
            </div>
            <ul class="nav-links">
                <li><a href="index.php#features">Features</a></li>
                <li><a href="pricing.php">Pricing</a></li>
                <li><a href="help-center.php" class="active">Help</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
            <div class="nav-actions">
                <a href="login.php" class="btn-login">Login</a>
                <a href="register.php" class="btn-signup">Sign Up</a>
            </div>
            <button class="mobile-menu-toggle" id="mobileMenuToggle">
                <i class="ti ti-menu-2"></i>
            </button>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <button class="mobile-menu-close" id="mobileMenuClose">
            <i class="ti ti-x"></i>
        </button>
        <ul class="mobile-nav-links">
            <li><a href="index.php#features">Features</a></li>
            <li><a href="pricing.php">Pricing</a></li>
            <li><a href="help-center.php">Help</a></li>
            <li><a href="contact. php">Contact</a></li>
            <li><a href="login.php" class="mobile-login">Login</a></li>
            <li><a href="register.php" class="mobile-signup">Sign Up</a></li>
        </ul>
    </div>

    <!-- Hero Section with Search -->
    <section class="help-hero">
        <div class="help-hero-content">
            <h1>How Can We Help You?</h1>
            <p>Search our knowledge base for quick answers</p>
            <form class="help-search-form">
                <i class="ti ti-search search-icon"></i>
                <input type="text" placeholder="Search for help..." id="helpSearch" />
                <button type="submit">Search</button>
            </form>
        </div>
    </section>

    <!-- Popular Topics -->
    <section class="popular-topics">
        <div class="section-container">
            <div class="section-header">
                <h2>Popular Topics</h2>
            </div>
            <div class="topics-grid">
                <div class="topic-card" id="account">
                    <div class="topic-icon">
                        <i class="ti ti-user-circle"></i>
                    </div>
                    <h3>Account Management</h3>
                    <p>Managing your account, settings, and profile</p>
                    <ul class="topic-links">
                        <li><a href="#">How to create an account</a></li>
                        <li><a href="#">Reset your password</a></li>
                        <li><a href="#">Update profile information</a></li>
                        <li><a href="#">Close your account</a></li>
                    </ul>
                </div>

                <div class="topic-card" id="security">
                    <div class="topic-icon">
                        <i class="ti ti-shield-lock"></i>
                    </div>
                    <h3>Security & Privacy</h3>
                    <p>Keeping your account safe and secure</p>
                    <ul class="topic-links">
                        <li><a href="#">Enable two-factor authentication</a></li>
                        <li><a href="#">Recognize phishing attempts</a></li>
                        <li><a href="#">Secure your account</a></li>
                        <li><a href="#">Report suspicious activity</a></li>
                    </ul>
                </div>

                <div class="topic-card" id="payments">
                    <div class="topic-icon">
                        <i class="ti ti-credit-card"></i>
                    </div>
                    <h3>Payments & Transfers</h3>
                    <p>Sending and receiving money</p>
                    <ul class="topic-links">
                        <li><a href="#">How to send money</a></li>
                        <li><a href="#">Transfer limits</a></li>
                        <li><a href="#">Track a transfer</a></li>
                        <li><a href="#">Failed transaction help</a></li>
                    </ul>
                </div>

                <div class="topic-card">
                    <div class="topic-icon">
                        <i class="ti ti-receipt"></i>
                    </div>
                    <h3>Transactions</h3>
                    <p>View and manage your transactions</p>
                    <ul class="topic-links">
                        <li><a href="#">View transaction history</a></li>
                        <li><a href="#">Download statements</a></li>
                        <li><a href="#">Dispute a transaction</a></li>
                        <li><a href="#">Transaction receipts</a></li>
                    </ul>
                </div>

                <div class="topic-card">
                    <div class="topic-icon">
                        <i class="ti ti-device-mobile"></i>
                    </div>
                    <h3>Mobile App</h3>
                    <p>Using D'Bag Bank on mobile</p>
                    <ul class="topic-links">
                        <li><a href="#">Download the app</a></li>
                        <li><a href="#">App features</a></li>
                        <li><a href="#">Troubleshoot app issues</a></li>
                        <li><a href="#">Update the app</a></li>
                    </ul>
                </div>

                <div class="topic-card">
                    <div class="topic-icon">
                        <i class="ti ti-settings"></i>
                    </div>
                    <h3>Settings & Preferences</h3>
                    <p>Customize your experience</p>
                    <ul class="topic-links">
                        <li><a href="#">Notification settings</a></li>
                        <li><a href="#">Language preferences</a></li>
                        <li><a href="#">Privacy settings</a></li>
                        <li><a href="#">Linked accounts</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQs -->
    <section class="faqs-section">
        <div class="section-container">
            <div class="section-header">
                <span class="section-badge">FAQs</span>
                <h2>Frequently Asked Questions</h2>
            </div>

            <div class="faq-list">
                <div class="faq-item">
                    <button class="faq-question">
                        <span>What are the fees for using D'Bag Bank?</span>
                        <i class="ti ti-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <p>D'Bag Bank is free to use! We don't charge monthly fees or hidden charges. You only pay standard transaction fees for certain services like external transfers. </p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question">
                        <span>How long do transfers take?</span>
                        <i class="ti ti-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <p>Internal transfers between D'Bag Bank users are instant. External transfers to other banks typically take 1-2 business days depending on the receiving bank.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question">
                        <span>Is my money safe with D'Bag Bank?</span>
                        <i class="ti ti-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <p>Yes! We use bank-level 256-bit SSL encryption, two-factor authentication, and follow strict security protocols. Your funds are also insured up to ₦500,000.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question">
                        <span>Can I use D'Bag Bank outside Nigeria?</span>
                        <i class="ti ti-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <p>Currently, D'Bag Bank is available only in Nigeria. However, you can access your account from anywhere in the world through our web and mobile apps.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question">
                        <span>What do I need to open an account?</span>
                        <i class="ti ti-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <p>You need a valid email address, phone number, and government-issued ID. The entire process takes less than 5 minutes! </p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question">
                        <span>How do I contact customer support?</span>
                        <i class="ti ti-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <p>You can reach us via email at support@dbagbank. com, call us at +234 123 456 7890, or use our live chat feature available 24/7.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Still Need Help -->
    <section class="need-help">
        <div class="section-container">
            <div class="need-help-content">
                <h2>Still Need Help?</h2>
                <p>Can't find what you're looking for? Our support team is here to help</p>
                <div class="help-actions">
                    <a href="contact.php" class="btn-primary large">
                        Contact Support
                        <i class="ti ti-arrow-right"></i>
                    </a>
                    <button class="btn-secondary large">
                        <i class="ti ti-message-circle"></i>
                        Start Live Chat
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php require_once __DIR__ . "/includes/components/footer.php"; ?>

    <script src="public/assets/js/pages.js"></script>
</body>

</html>