<?php
// determine whether to show balance or mask it
$show_balance = isset($_SESSION['show_balance']) ? $_SESSION['show_balance'] : true;

$balanceDisplay = $show_balance ? number_format($user->balance, 2) : "****";
$iconClass = $show_balance ? 'ti-eye-off' :  'ti-eye';

// for Account Number display, we always show last 4 digits only
$full_acct = $user->account_number;
$maskd_acct = str_repeat('*', strlen($full_acct) - 4) . substr($full_acct, -4);
$show_acct = isset($_SESSION['show_account_number']) ? $_SESSION['show_account_number'] : false;
$display_acct = $show_acct ? $full_acct : $maskd_acct;
?>


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