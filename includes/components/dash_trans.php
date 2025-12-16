<?php
// Get last 4 transactions for the logged-in user
$user_id = $user->id;
$db = new Database();
$stmt = $db->getPdo()->prepare("SELECT * FROM transactions WHERE user_id = ? ORDER BY created_at DESC LIMIT 4");
$stmt->execute([$user_id]);
$transactions = $stmt->fetchAll();
?>
<section class="transactions">
    <header class="flex-space">
        <h3>Transactions</h3>
        <a href="transactions.php">See All</a>
    </header>
    <?php if (count($transactions) > 0): ?>
        <ul class="transaction-list">
            <?php foreach ($transactions as $trans): ?>
                <li class="transaction flex-" onclick="window.location.href='transfer_success.php?ref=<?= $trans->reference ?>'">
                    <div class="trans-icon <?= $trans->type ?>">
                        <i class="ti <?= $trans->type === 'credit' ? 'ti-arrow-down-left' : 'ti-arrow-up-right' ?>"></i>
                    </div>
                    <div class="trans-info">
                        <span class="trans-name bold"><?= ucfirst($trans->type) ?></span>
                        <span class="trans-time"><?= date('M d, g:i A', strtotime($trans->created_at)) ?></span>
                    </div>
                    <div class="amount">
                        <span class="trans-amount bold <?= $trans->type === 'credit' ? 'credit' : 'debit' ?>">
                            <?= $trans->type === 'credit' ? '+' : '-' ?>₦<?= number_format($trans->amount, 2) ?>
                        </span>
                        <span class="trans-type <?= $trans->type ?>"><?= $trans->type === 'credit' ? 'Received' : 'Sent' ?></span>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p class="no-transactions">No transactions yet</p>
    <?php endif; ?>
</section>