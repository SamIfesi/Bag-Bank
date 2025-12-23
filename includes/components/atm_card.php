<?php
// Check if user has a card
$hasCard = !empty($user->card_number) && $user->card_status === 'active';

if ($hasCard) {
    // Format card number with spaces (XXXX XXXX XXXX XXXX)
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
    
    // Determine if this section should be shown based on saved page
    $current_page = isset($_SESSION['current_page']) ? $_SESSION['current_page'] : 'home';
    $hide_card = ($current_page !== 'card') ? 'hide' : '';
?>

    <section class="atm-card-container <?= $hide_card; ?> nav-section" data-name="card">
        <div class="atm-card">
            <div class="card-header">
                <div class="card-logo">
                    <span class="bank-name">D'bag Bank</span>
                </div>
                <div class="card-type">
                    <span>DEBIT</span>
                </div>
            </div>

            <div class="card-chip">
                <svg width="50" height="40" viewBox="0 0 50 40">
                    <rect x="5" y="5" width="40" height="30" rx="5" fill="#FFD700" />
                    <rect x="10" y="10" width="10" height="8" fill="#FFA500" />
                    <rect x="25" y="10" width="10" height="8" fill="#FFA500" />
                    <rect x="10" y="22" width="10" height="8" fill="#FFA500" />
                    <rect x="25" y="22" width="10" height="8" fill="#FFA500" />
                </svg>
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
                    <span class="value">***</span>
                </div>
            </div>

            <div class="card-footer">
                <div class="mastercard-logo">
                    <svg width="60" height="40" viewBox="0 0 60 40">
                        <circle cx="20" cy="20" r="15" fill="#EB001B" opacity="0.8" />
                        <circle cx="40" cy="20" r="15" fill="#F79E1B" opacity="0.8" />
                    </svg>
                </div>
            </div>
        </div>
    </section>

<?php
} else {
    // User doesn't have a card - show apply button
?>
<?php
// Determine if this section should be shown based on saved page
$current_page = isset($_SESSION['current_page']) ? $_SESSION['current_page'] : 'home';
$hide_card = ($current_page !== 'card') ? 'hide' : '';
?>
    <section class="atm-card-container <?= $hide_card; ?> nav-section" data-name="card">
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

        <div class="no-card-section">
            <div class="no-card-icon">
                <i class="ti ti-credit-card"></i>
            </div>
            <h3>Get Your Debit Card</h3>
            <p>Apply for a virtual debit card to make online payments and withdraw cash.</p>
            <button class="btn-apply-card" id="applyCardBtn">
                <i class="ti ti-plus"></i> Apply for Card
            </button>
        </div>

        <div class="loading-card" id="loadingCard" style="display: none;">
            <div class="spinner"></div>
            <p>Processing your application...</p>
        </div>
    </section>

<?php } ?>