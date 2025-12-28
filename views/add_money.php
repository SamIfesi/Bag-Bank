<?php
session_start();
require_once __DIR__ . "/../config/functions/utilities.php";
require_once __DIR__ . "/../includes/check_auth.php";

$user = Auth::user();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="public/favicon.svg" type="image/svg" />
    <link rel="stylesheet" href="public/assets/css/add-money.css">
    <title>Add Money - D'Bag Bank</title>
</head>

<body class="add-money-body">
    <div class="loader-container hide" id="loader">
        <div class="loader">
            <div class="spinner"></div>
        </div>
    </div>

    <header class="add-money-header">
        <button class="back-btn" id="backBtn">
            <i class="ti ti-chevron-left"></i>
        </button>
        <h2>Add Money</h2>
        <span></span>
    </header>

    <main class="add-money-container">
        <!-- Current Balance Display -->
        <section class="balance-display">
            <p class="balance-label">Current Balance</p>
            <!-- <h1 class="balance-amount">₦<?= number_format($user->balance, 2) ?></h1> -->
        </section>

        <!-- Add Money Form -->
        <form class="add-money-form" id="addMoneyForm">
            <!-- Amount Input -->
            <div class="section">
                <label for="amount">Enter Amount</label>
                <div class="input-group">
                    <span class="currency-symbol">₦</span>
                    <input
                        type="text"
                        class="input"
                        id="amount"
                        name="amount"
                        placeholder="0.00"
                        inputmode="decimal"
                        autocomplete="off"
                        required />
                </div>
                <div class="amount-limits">
                    <span class="limit-text">Min: ₦100.00</span>
                    <span class="limit-text">Max: ₦10,000.00</span>
                </div>
                <span class="error" id="amount-error">Amount must be between ₦100.00 and ₦10,000.00</span>
            </div>

            <!-- Quick Amount Buttons -->
            <div class="quick-amounts">
                <button type="button" class="quick-btn" data-amount="500">₦500</button>
                <button type="button" class="quick-btn" data-amount="1000">₦1,000</button>
                <button type="button" class="quick-btn" data-amount="2000">₦2,000</button>
                <button type="button" class="quick-btn" data-amount="5000">₦5,000</button>
                <button type="button" class="quick-btn" data-amount="10000">₦10,000</button>
            </div>

            <!-- Payment Method Selection -->
            <div class="section">
                <label>Payment Method</label>
                <div class="payment-methods">
                    <label class="payment-option">
                        <input type="radio" name="payment_method" value="card" checked />
                        <div class="option-content">
                            <i class="ti ti-credit-card"></i>
                            <span>Debit Card</span>
                        </div>
                    </label>
                    <label class="payment-option">
                        <input type="radio" name="payment_method" value="bank" />
                        <div class="option-content">
                            <i class="ti ti-building-bank"></i>
                            <span>Bank Transfer</span>
                        </div>
                    </label>
                    <label class="payment-option">
                        <input type="radio" name="payment_method" value="ussd" />
                        <div class="option-content">
                            <i class="ti ti-phone"></i>
                            <span>USSD</span>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Description (Optional) -->
            <div class="section">
                <label for="description">Description (Optional)</label>
                <input
                    type="text"
                    id="description"
                    name="description"
                    placeholder="e.g., Wallet top-up"
                    class="form-input" />
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn-add-money" id="addMoneyBtn" disabled>
                <i class="ti ti-plus"></i>
                Add Money
            </button>
        </form>

        <!-- Info Card -->
        <div class="info-card">
            <i class="ti ti-info-circle"></i>
            <div>
                <h4>Quick & Secure</h4>
                <p>Your money will be added instantly to your account.  All transactions are encrypted and secure.</p>
            </div>
        </div>
    </main>

    <!-- Success Modal -->
    <div class="modal" id="successModal">
        <div class="modal-content success">
            <div class="modal-icon">
                <i class="ti ti-check"></i>
            </div>
            <h3>Money Added Successfully!</h3>
            <p class="modal-amount" id="modalAmount">₦0.00</p>
            <p class="modal-message">Your new balance is <span id="newBalance">₦0.00</span></p>
            <button class="modal-btn" id="doneBtn">Done</button>
        </div>
    </div>

    <!-- Error Modal -->
    <div class="modal" id="errorModal">
        <div class="modal-content error">
            <div class="modal-icon">
                <i class="ti ti-x"></i>
            </div>
            <h3>Transaction Failed</h3>
            <p class="modal-message" id="errorMessage">Something went wrong. Please try again.</p>
            <button class="modal-btn" id="tryAgainBtn">Try Again</button>
        </div>
    </div>

    <script src="public/assets/js/add-money.js"></script>
</body>

</html>