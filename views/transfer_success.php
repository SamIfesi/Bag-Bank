<?php
session_start();
require_once __DIR__ . "/../config/functions/utilities.php";
require_once __DIR__ . "/../config/Auth.php";
require_once __DIR__ . "/../includes/check_auth.php";

if (!is_logged_in()) {
    redirect_to("views/login.php");
    exit();
}

$transaction_ref = isset($_GET['ref']) ? sanitize_input($_GET['ref']) : '';

if (empty($transaction_ref)) {
    redirect_to("views/dashboard.php");
    exit();
}
$transaction = Model::find('transactions', 'reference', $transaction_ref);

if (!$transaction) {
    redirect_to("views/dashboard.php");
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
    <link rel="stylesheet" href="../public/assets/css/receipt.css">
    <title>Transfer Receipt - D'Bag Bank</title>
</head>

<body class="receipt-body">
    <!-- Success/Failed Modal Popup -->
    <div class="status-modal active" id="statusModal">
        <div class="status-content">
            <div class="status-icon <?= $transaction->status === 'success' ? 'success' : 'failed' ?>">
                <?php if ($transaction->status === 'success'): ?>
                    <i class="ti ti-circle-check"></i>
                <?php else: ?>
                    <i class="ti ti-circle-x"></i>
                <?php endif; ?>
            </div>
            <h2><?= $transaction->status === 'success' ? 'Transfer Successful!' : 'Transfer Failed' ?></h2>
            <p class="status-amount">₦<?= number_format($transaction->amount, 2) ?></p>
            <p class="status-message">
                <?php if ($transaction->status === 'success'): ?>
                    Your transfer to <?= sanitize_input($transaction->recipient_name) ?> was successful
                <?php else: ?>
                    Your transfer could not be completed. Please try again.
                <?php endif; ?>
            </p>
            <div class="status-actions">
                <button class="btn-view-receipt" id="viewReceiptBtn">View Receipt</button>
                <button class="btn-back-dash" id="backToDashBtn">Back to Dashboard</button>
            </div>
        </div>
    </div>

    <!-- Detailed Receipt -->
    <main class="receipt-container hide" id="receiptContainer">
        <div class="receipt-card" id="printArea">
            <div class="receipt-header">
                <img src="../public/logo-stacked.svg" alt="D'Bag Bank" class="receipt-logo" />
                <h2>Transaction Receipt</h2>
                <p class="receipt-date"><?= date('F d, Y h:i A', strtotime($transaction->created_at)) ?></p>
            </div>

            <div class="receipt-status <?= $transaction->status ?>">
                <i class="ti ti-circle-check"></i>
                <span><?= ucfirst($transaction->status) ?></span>
            </div>

            <div class="receipt-details">
                <div class="detail-row">
                    <span class="detail-label">Transaction Type</span>
                    <span class="detail-value"><?= ucfirst($transaction->type) ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Amount</span>
                    <span class="detail-value amount">₦<?= number_format($transaction->amount, 2) ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Reference Number</span>
                    <span class="detail-value"><?= sanitize_input($transaction->reference) ?></span>
                </div>

                <?php if ($transaction->type === 'debit'): ?>
                    <div class="detail-row">
                        <span class="detail-label">Recipient Name</span>
                        <span class="detail-value"><?= sanitize_input($transaction->recipient_name) ?></span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Recipient Account</span>
                        <span class="detail-value"><?= sanitize_input($transaction->recipient_account) ?></span>
                    </div>
                <?php else: ?>
                    <div class="detail-row">
                        <span class="detail-label">Sender Name</span>
                        <span class="detail-value"><?= sanitize_input($transaction->sender_name) ?></span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Sender Account</span>
                        <span class="detail-value"><?= sanitize_input($transaction->sender_account) ?></span>
                    </div>
                <?php endif; ?>

                <div class="detail-row">
                    <span class="detail-label">Bank</span>
                    <span class="detail-value"><?= sanitize_input($transaction->bank_name) ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Description</span>
                    <span class="detail-value"><?= sanitize_input($transaction->description) ?></span>
                </div>
            </div>

            <div class="receipt-footer">
                <p>Thank you for banking with us!</p>
                <p class="small-text">This is a computer-generated receipt</p>
            </div>
        </div>

        <div class="receipt-actions no-print">
            <button class="btn-print" id="printBtn">
                <i class="ti ti-printer"></i>
                Print Receipt
            </button>
            <button class="btn-download" id="downloadBtn">
                <i class="ti ti-download"></i>
                Download PDF
            </button>
            <button class="btn-back" id="backBtn">Back to Dashboard</button>
        </div>
    </main>

    <script src="../public/assets/js/receipt.js"></script>
</body>

</html>