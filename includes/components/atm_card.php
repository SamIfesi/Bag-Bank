<?php
// Check if user has a card
$hasCard = !empty($user->card_number) && $user->card_status === 'active';
$cvv_card = !empty($user->card_cvv) ? $user->card_cvv : null && $hasCard;

if ($cvv_card) {
    $card_cvv = $user->card_cvv;
    $formatted_cvv = trim($card_cvv);
    $masked_cvv = str_repeat('*', strlen($card_cvv));

    $show_cvv = isset($_SESSION['show_full_card']) ? $_SESSION['show_full_card'] : false;
    $display_cvv = $show_cvv ? $card_cvv : $masked_cvv;
}
if (!empty($user->card_number)) {
    $atm_number = $user->card_number;
    $formatted_atm = chunk_split($atm_number, 4, '-');
    $formatted_atm = rtrim($formatted_atm, '-');
}

if ($hasCard) {
    // Format card number with spaces 
    $card_number = $user->card_number;
    $formatted_card = chunk_split($card_number, 4, ' ');
    $formatted_card = trim($formatted_card);

    // Mask card number for display (show last 4 digits)
    $masked_card = str_repeat('*', 4) . ' ' .
        str_repeat('*', 4) . ' ' .
        str_repeat('*', 4) . ' ' .
        substr($card_number, -4);

    $show_full_card = isset($_SESSION['show_full_card']) ? $_SESSION['show_full_card'] : false;
    $display_card = $show_full_card ? $formatted_card : $masked_card;
?>

    <section class="atm-card-container <?= $hide_card; ?> section nav-section" data-name="card">
        <header class="home-header flex-space card-header">
            <div class="topbar-left">
                <h2>
                    Card
                </h2>
            </div>

            <div class="topbar-right">
                <button class="notifications">
                    <i class="ti ti-bell"></i>
                </button>
            </div>
        </header>
        <div class="atm-card">
            <div class="card-header">
                <div class="master-card">
                    <div class="mastercard-logo">
                        <svg width="60" height="40" viewBox="0 0 60 40">
                            <circle cx="20" cy="20" r="15" fill="#EB001B" opacity="0.8" />
                            <circle cx="40" cy="20" r="15" fill="#F79E1B" opacity="0.8" />
                        </svg>
                    </div>
                </div>
                <div class="card-type">
                    <span>DEBIT CARD</span>
                </div>
            </div>

            <div class="deco">
                <span></span>
                <span></span>
                <span></span>
            </div>

            <div class="card-number" id="cardNumberDisplay" data-full="<?= $formatted_card; ?>" data-masked="<?= $masked_card; ?>">
                <span><?= $display_card; ?></span>
                <i class="ti <?= $show_full_card ? 'ti-eye-off' : 'ti-eye'; ?> toggle-card-view" id="cardToggleIcon"></i>
            </div>

            <div class="card-details">
                <div class="card-holder">
                    <span class="label">CARD HOLDER</span>
                    <span class="value"><?= strtoupper($user->name); ?></span>
                </div>
                <div class="card-expiry">
                    <span class="label">EXPIRES</span>
                    <span class="value"><?= $user->card_expiry; ?></span>
                </div>
                <div class="card-cvv">
                    <span class="label">CVV</span>
                    <span class="value" id="cvv" data-full="<?= $formatted_cvv; ?>" data-masked="<?= $masked_cvv; ?>"><?= $display_cvv; ?></span>
                </div>
            </div>
        </div>
        <div class="group-card-info">
            <div class="card-info">
                <label for="card-number">Card Number</label>
                <span class="label-copy hide" id="copied">Copied!</span>
                <div>
                    <i class="ti ti-copy" id="copy"></i>
                    <input type="text" id="card-number" value="<?= $formatted_atm ?>" readonly />
                </div>
            </div>
            <div class="card-exp">
                <span>
                    <label for="card-expiry">Expiry Date</label>
                    <input type="text" id="card-expiry" value="<?= $user->card_expiry ?>" readonly />
                </span>
                <span>
                    <label for="card-cvv">CVV</label>
                    <input type="number" id="card-cvv" value="<?= $user->card_cvv ?>" readonly />

                </span>
            </div>
            <div class="card-info">
                <label for="card-name">Card Holder Name</label>
                <input type="text" id="card-name" value="<?= strtoupper($user->name) ?>" readonly />
            </div>
        </div>
    </section>

<?php
} else {
    // User doesn't have a card - show apply button
?>
    <section class="atm-card-container <?= $hide_card; ?> nav-section " data-name="card">
        <header class="home-header flex-space card-header">
            <div class="topbar-left">
                <h2>
                    Card
                </h2>
            </div>

            <div class="topbar-right">
                <button class="notifications">
                    <i class="ti ti-bell"></i>
                </button>
            </div>
        </header>

        <div class="no-card-section" id="noCardSection">
            <div class="no-card-icon">
                <i class="ti ti-credit-card"></i>
            </div>
            <h3>Get Your Debit Card</h3>
            <p>Apply for a virtual debit card to make online payments and withdraw cash.</p>
            <button class="btn-apply-card" id="applyCardBtn">
                <i class="ti ti-plus"></i> Apply for Card
            </button>
        </div>


        <div class="msg" id="msg">
            <span>
                <i class="ti" id="icon"></i>
            </span>
            <span id="messageText"></span>
        </div>

        <div class="loading-card hide" id="loadingCard">
            <div class="spinner"></div>
            <p>Processing your application...</p>
        </div>
    </section>

<?php } ?>