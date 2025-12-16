<?php
session_start();
require_once __DIR__ . "/config/functions/utilities.php";
require_once __DIR__ . "/config/Auth.php";
require_once __DIR__ . "/includes/check_auth.php";

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
    <link rel="shortcut icon" href="public/favicon.svg" type="image/svg" />
    <link rel="stylesheet" href="src/transactions.css">
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
        <?php if (count($all_transactions) > 0): ?>
            <ul class="trans-list">
                <?php foreach ($all_transactions as $trans): ?>
                    <li class="trans-item" onclick="window.location.href='transfer_success.php?ref=<?= $trans->reference ?>'">
                        <div class="trans-icon <?= $trans->type ?>">
                            <i class="ti <?= $trans->type === 'credit' ? 'ti-arrow-down-left' : 'ti-arrow-up-right' ?>"></i>
                        </div>
                        <div class="trans-details">
                            <h4 class="trans-title">
                                <?= $trans->type === 'credit' ? htmlspecialchars($trans->sender_name) : htmlspecialchars($trans->recipient_name) ?>
                            </h4>
                            <p class="trans-desc"><?= htmlspecialchars($trans->description) ?></p>
                            <p class="trans-date"><?= date('F d, Y - g:i A', strtotime($trans->created_at)) ?></p>
                        </div>
                        <div class="trans-amount-wrapper">
                            <span class="trans-amount <?= $trans->type ?>">
                                <?= $trans->type === 'credit' ?  '+' : '-' ?>₦<?= number_format($trans->amount, 2) ?>
                            </span>
                            <span class="trans-status <?= $trans->status ?>"><?= ucfirst($trans->status) ?></span>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <div class="empty-state">
                <i class="ti ti-receipt-off"></i>
                <h3>No Transactions Yet</h3>
                <p>Your transaction history will appear here</p>
                <button class="btn-send-money" onclick="window.location.href='send.php'">Send Money</button>
            </div>
        <?php endif; ?>
    </main>
</body>

</html>