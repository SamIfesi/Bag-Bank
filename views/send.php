<?php
session_start();
require_once __DIR__ . "/../config/functions/utilities.php";
require_once  __DIR__ . "/../config/Auth.php";
require_once __DIR__ . "/../includes/check_auth.php";

if (!is_logged_in()) {
  redirect_to("login.php");
  exit();
}
$user = Auth::user();
$banks = Model::all('banks');

$bank_options = '';
if ($banks):
  $banks_reversed = array_reverse($banks);
  foreach ($banks_reversed as $bank):
    $bank_options .= '<option value="' . htmlspecialchars($bank->code) . '">';
    $bank_options .= htmlspecialchars($bank->name);
    $bank_options .= '</option>';
  endforeach;
endif;

require_once __DIR__ . "/../includes/components/send_header.php";
require_once __DIR__ . "/../includes/components/send_account.php";
require_once __DIR__ . "/../includes/components/send_amount.php";
