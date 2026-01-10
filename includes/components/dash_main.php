<section class="nav-section section <?= $hide_home; ?>" data-name="home">
    <header class="home-header flex-space">
        <div class="topbar-left">
            <h2>Hi,
                <span><?= htmlspecialchars(ucfirst($user->username)); ?></span>
            </h2>
            <p>How are you today?</p>
        </div>

        <div class="topbar-right">
            <button class="reward">
                <i class="ti ti-gift"></i>
                <span>Reward</span>
            </button>
            <button class="notifications" onclick="window.location.href='notification.php'">
                <i class="ti ti-bell"></i>
            </button>
        </div>
    </header>

    <section class="wallet-card card-purple">
        <div class="flex-space">
            <div class="balance">
                <h3 class="bal" id="bal" data-amount="<?= number_format($user->balance, 2); ?>">
                    ₦ <span id="amount-text"><?= $balanceDisplay; ?></span>
                </h3>
            </div>
            <i class="ti <?= $iconClass; ?> view-bal" id="balIcon"></i>
        </div>

        <div class="actions flex-space">
            <div class="wallet-card-details" id="acctToggleBtn" data-full="<?= $full_acct; ?>" data-masked="<?= $maskd_acct; ?>">
                <span>Acct Number
                    <p id="acctText">
                        <?= $display_acct ?>
                    </p>
                </span>
            </div>

            <button class="btn-add" onclick="window.location.href='add_money.php'">Add Money</button>
        </div>
    </section>

    <nav class=" quick-actions flex-space">
        <span class="action-btn">
            <i class="ti ti-sort-ascending" id="sendBtn" onclick="window.location.href='send.php'"></i>
            <span>Send</span>
        </span>
        <span class="action-btn">
            <i class="ti ti-sort-descending" id="receiveBtn"></i>
            <span>Receive</span>
        </span>
        <span class="action-btn">
            <i class="ti ti-archive" id="withdrawBtn"></i>
            <span>Withdraw</span>
        </span>
        <span class="action-btn">
            <i class="ti ti-category-plus" id="moreBtn"></i>
            <span>More</span>
        </span>
    </nav>

    <section class="transactions">
        <header class="flex-space">
            <h3>Transactions</h3>
            <a href="transactions.php">See All</a>
        </header>
        <?php if (count($transactions) > 0): ?>
            <ul class="trans-list" id="transactionsList">
                <?php foreach ($all_transactions as $trans): ?>
                    <li class="trans-item" data-type="<?= $trans->type ?>" data-description="<?= htmlspecialchars($trans->description) ?>" onclick="window.location.href='transfer_success.php?ref=<?= $trans->reference ?>'">
                        <div class="trans-icon <?= $trans->type ?>">
                            <i class="ti <?= $trans->type === 'credit' ? 'ti-arrow-down-left' : ($trans->type === 'top_up' ? 'ti-credit-card' : 'ti-arrow-up-right') ?>"></i>
                        </div>
                        <div class="trans-details">
                            <h4 class="trans-title">
                                <?= $trans->type === 'credit' ? 'Received' : ($trans->type === 'top_up' ? 'Top Up' : 'Transfer') ?>
                            </h4>
                            <p class="trans-date"><?= date('M d, Y - g:i A', strtotime($trans->created_at)) ?></p>
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
    </section>
</section>