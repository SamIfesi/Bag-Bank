<section class="<?= $hide_transactions ?> nav-section" data-name="transactions">

    <header class="trans-header">
        <h2>Transaction History</h2>
    </header>

    <main class="trans-main">
        <div class="filter-buttons">
            <button class="filter-btn active" data-filter="all" onclick="filterTransactions('all')">All</button>
            <button class="filter-btn" data-filter="credit" onclick="filterTransactions('credit')">Credit</button>
            <button class="filter-btn" data-filter="debit" onclick="filterTransactions('debit')">Debit</button>
            <button class="filter-btn" data-filter="topup" onclick="filterTransactions('topup')">Top Up</button>
        </div>

        <?php if (count($all_transactions) > 0): ?>
            <ul class="trans-list" id="transactionsList">
                <?php foreach ($all_transactions as $trans): ?>
                    <li class="trans-item" data-type="<?= $trans->type ?>" data-description="<?= htmlspecialchars($trans->description) ?>" onclick="window.location.href='transfer_success.php?ref=<?= $trans->reference ?>'">
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
            <div class="empty-state" id="emptyState" style="display: none;">
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
                <button class="btn-send-money" onclick="window.location.href='send.php'">Send Money</button>
            </div>
        <?php endif; ?>
    </main>

    <script src="../public/assets/js/transactions.js"></script>
</section>