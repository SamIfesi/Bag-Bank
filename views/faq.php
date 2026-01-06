<?php
session_start();
require_once __DIR__ . "/../config/functions/utilities.php";
require_once __DIR__ . "/../config/Auth.php";
require_once __DIR__ . "/../includes/check_auth.php";

$user = Auth::user();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help Center - D'Bag Bank</title>
    <link rel="shortcut icon" href="../public/favicon.svg" type="image/svg+xml">
    <link rel="stylesheet" href="../public/assets/css/faq.css">
</head>

<body>

    <!-- Header -->
    <header class="help-header">
        <div class="header-top">
            <button class="back-btn" onclick="history.back()">
                <i class="ti ti-chevron-left"></i>
            </button>
            <h1>Help Center</h1>
            <div class="placeholder"></div> <!-- Spacing balance -->
        </div>

        <!-- Search Bar -->
        <div class="search-container">
            <i class="ti ti-search"></i>
            <input type="text" id="faqSearch" placeholder="Search for answers...">
        </div>
    </header>

    <main class="help-content">
        <!-- Quick Support Options -->
        <section class="support-cards">
            <a href="live-chat.php" class="support-card highlight">
                <div class="icon-box">
                    <i class="ti ti-message-chatbot"></i>
                </div>
                <div class="card-text">
                    <h3>Chat with Baggy</h3>
                    <p>Instant AI support 24/7</p>
                </div>
                <i class="ti ti-chevron-right"></i>
            </a>

            <a href="mailto:support@dbagbank.com" class="support-card">
                <div class="icon-box blue">
                    <i class="ti ti-mail"></i>
                </div>
                <div class="card-text">
                    <h3>Email Support</h3>
                    <p>Get a reply in 24hrs</p>
                </div>
                <i class="ti ti-chevron-right"></i>
            </a>
        </section>

        <!-- FAQ Categories -->
        <section class="faq-section">
            <h2 class="section-title">Frequently Asked Questions</h2>

            <!-- Category: Account -->
            <div class="faq-category">
                <h3 class="category-title">Account & Security</h3>

                <div class="accordion-item">
                    <button class="accordion-header">
                        <span>How do I check my account balance?</span>
                        <i class="ti ti-plus"></i>
                    </button>
                    <div class="accordion-body">
                        <p>You can check your balance instantly on your Dashboard home screen. You can also ask our AI assistant, Baggy, in the Live Chat.</p>
                    </div>
                </div>

                <div class="accordion-item">
                    <button class="accordion-header">
                        <span>How do I reset my transaction PIN?</span>
                        <i class="ti ti-plus"></i>
                    </button>
                    <div class="accordion-body">
                        <p>Go to <strong>Profile > Security > Change PIN</strong>. You will need your password and an OTP sent to your registered email to verify the change.</p>
                    </div>
                </div>

                <div class="accordion-item">
                    <button class="accordion-header">
                        <span>Is my money safe with D'Bag Bank?</span>
                        <i class="ti ti-plus"></i>
                    </button>
                    <div class="accordion-body">
                        <p>Yes! We use bank-grade 256-bit encryption to secure your data and funds. We are also fully insured by the NDIC.</p>
                    </div>
                </div>
            </div>

            <!-- Category: Transfers -->
            <div class="faq-category">
                <h3 class="category-title">Transfers & Payments</h3>

                <div class="accordion-item">
                    <button class="accordion-header">
                        <span>What are the transfer fees?</span>
                        <i class="ti ti-plus"></i>
                    </button>
                    <div class="accordion-body">
                        <p>Transfers to other D'Bag accounts are <strong>FREE</strong>. Transfers to other banks cost between ₦10 and ₦50 depending on the amount.</p>
                    </div>
                </div>

                <div class="accordion-item">
                    <button class="accordion-header">
                        <span>My transfer failed but I was debited?</span>
                        <i class="ti ti-plus"></i>
                    </button>
                    <div class="accordion-body">
                        <p>Don't panic! This is usually automatically reversed within 24 hours. If it persists, please contact support with the Transaction Reference ID.</p>
                    </div>
                </div>
                <div class="accordion-item">
                    <button class="accordion-header">
                        <span>What is the daily transfer limit?</span>
                        <i class="ti ti-plus"></i>
                    </button>
                    <div class="accordion-body">
                        <p>For standard Tier 1 accounts, the daily limit is ₦500,000. Tier 2 accounts have a limit of ₦5,000,000. You can upgrade your tier in the Profile settings.</p>
                    </div>
                </div>
            </div>
            <!-- Category: Cards -->
            <div class="faq-category">
                <h3 class="category-title">Cards</h3>

                <div class="accordion-item">
                    <button class="accordion-header">
                        <span>How do I get a Virtual Dollar Card?</span>
                        <i class="ti ti-plus"></i>
                    </button>
                    <div class="accordion-body">
                        <p>Navigate to the <strong>Cards</strong> tab and select "Create Virtual Card". You can fund it instantly from your naira balance.</p>
                    </div>
                </div>
            </div>

        </section>
    </main>

    <script src="../public/assets/js/faq.js"></script>
</body>

</html>