<?php
session_start();
require_once __DIR__ . "/../config/functions/utilities.php";
require_once __DIR__ . "/../config/Auth.php";
require_once __DIR__ . "/../includes/check_auth.php";

if (!is_logged_in()) {
    redirect_to("login.php");
    exit();
}

$user = Auth::user();

$db = new Database();
$stmt = $db->getPdo()->prepare("SELECT * FROM transactions WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$user->id]);
$all_transactions = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="../public/favicon.svg" type="image/svg" />
    <link rel="stylesheet" href="../public/assets/css/transactions.css">
    <title>Transaction History - D'Bag Bank</title>
</head>

<body class="transactions-body">
    <header class="trans-header">
        <button class="back-btn" onclick="window.location.href='dashboard.php'">
            <i class="ti ti-chevron-left"></i>
        </button>
        <h2>Transaction History</h2>
        <span></span>
    </header>

    <main class="trans-main">
        <div class="filter-buttons">
            <button class="filter-btn active" data-filter="all">All</button>
            <button class="filter-btn" data-filter="credit">Credit</button>
            <button class="filter-btn" data-filter="debit">Debit</button>
            <button class="filter-btn" data-filter="top_up">Top Up</button>
        </div>

        <?php if (count($all_transactions) > 0): ?>
            <ul class="trans-list" id="transactionsList">
                <?php foreach ($all_transactions as $trans): ?>
                    <li class="trans-item" data-type="<?= $trans->type ?>" data-description="<?= htmlspecialchars($trans->description) ?>" onclick="window.location.href='transfer_success.php?ref=<?= $trans->reference ?>'">
                        <div class="trans-icon <?= $trans->type ?>">
                            <i class="ti <?= $trans->type === 'credit' ? 'ti-arrow-down-left' : ($trans->type === 'top_up' ? 'ti-credit-card' : 'ti-arrow-up-right') ?>"></i>
                        </div>
                        <div class="trans-details">
                            <h4 class="trans-title">
                                <?= $trans->type === 'top_up' ? "Top up" : ($trans->type === 'credit' ? htmlspecialchars($trans->sender_name) : htmlspecialchars($trans->recipient_name)) ?>
                            </h4>
                            <p class="trans-desc"><?= htmlspecialchars($trans->description) ?></p>
                            <p class="trans-date"><?= date('M d, Y - g:i A', strtotime($trans->created_at)) ?></p>
                        </div>
                        <div class="trans-amount-wrapper">
                            <span class="trans-amount <?= $trans->type ?>">
                                <?= $trans->type === 'credit' ?  '+' : ($trans->type === 'debit' ? '-' : '') ?>₦<?= number_format($trans->amount, 2) ?>
                            </span>
                            <span class="trans-status <?= $trans->status ?>"><?= ucfirst($trans->status) ?></span>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
            <div class="empty-state" id="emptyTrans" style="display: none;">
                <i class="ti ti-receipt-off"></i>
                <h3>No Transactions Found</h3>
                <p>No transactions match your selected filter</p>
                <button class="btn-send-money" id="noTransaction"></button>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <i class="ti ti-receipt-off"></i>
                <h3>No Transactions Yet</h3>
                <p>Your transaction history will appear here</p>
                <button class="btn-send-money" id="noTransactionYet">Send Money</button>
            </div>
        <?php endif; ?>
    </main>

    <script src="../public/assets/js/transactions.js"></script>
</body>

</html>