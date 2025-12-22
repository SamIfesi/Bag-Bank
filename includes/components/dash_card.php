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