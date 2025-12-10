<?php
$show_balance = isset($_SESSION['show_balance']) ? $_SESSION['show_balance'] : true;

$balanceDisplay = $show_balance ? number_format($user->balance, 2) : "****";
$iconClass = $show_balance ? 'ti-eye-off' :  'ti-eye';
?>
<section class="wallet-card card-purple">
    <div class="flex-space">
        <div class="balance">
            <h3 class="bal" id="bal" data-amount="<?= number_format($user->balance, 2); ?>">
                ₦ <span id="amount-text"><?= $balanceDisplay; ?></span>
            </h3>
        </div>
        <i class="ti <?= $iconClass; ?> view-bal" id="balShow"></i>
    </div>

    <div class="actions flex-space">
        <div class="wallet-card-details">
            <span>Acct Number
                <p>
                    <?= str_repeat('*', strlen($user->account_number) - 4) . substr($user->account_number, -4); ?>
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