<?php
// Determine if this section should be shown based on saved page
$current_page = isset($_SESSION['current_page']) ? $_SESSION['current_page'] : 'home';
$hide_home = ($current_page !== 'home') ? 'hide' : '';
?>
    <section class="nav-section <?= $hide_home; ?>" data-name="home">
        <header class="home-header flex-space">
            <div class="topbar-left">
                <h2>Hi,
                    <span><?php echo htmlspecialchars($user->username); ?></span>
                </h2>
                <p>How are you today?</p>
            </div>

            <div class="topbar-right">
                <button class="reward">
                    <i class="ti ti-gift"></i>
                    <span>Reward</span>
                </button>
                <button class="notifications">
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

                <button class="btn-add">Add Money</button>
            </div>
        </section>

        <nav class="quick-actions flex-space">
            <span class="action-btn">
                <i class="ti ti-sort-ascending" id="sendBtn"></i>
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
    </section>