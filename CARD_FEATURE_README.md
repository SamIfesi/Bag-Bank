# ATM Card Feature - Implementation Guide

## Overview
This feature allows users to apply for and receive a virtual ATM/debit card with a unique 16-digit card number, CVV, and expiry date.

## Features Implemented

### 1. **Conditional UI Display**
   - If user has no card: Shows "Apply for Card" button
   - If user has card: Shows beautiful ATM card with details

### 2. **Card Generation**
   - Generates valid 16-digit card numbers using Luhn algorithm
   - Creates 3-digit CVV
   - Sets expiry date (5 years from issue)
   - Ensures unique card numbers

### 3. **Database Storage**
   - Card number stored securely
   - Card status tracking (none, pending, active, blocked)
   - Issue timestamp

### 4. **Security Features**
   - Card number masking (shows last 4 digits)
   - Toggle visibility option
   - Session-based preference saving

## Setup Instructions

### Step 1: Run Database Migration

Open phpMyAdmin or your MySQL client and run the migration file:

```sql
-- File: config/migrations/add_card_fields.sql
ALTER TABLE `users` 
ADD COLUMN `card_number` VARCHAR(16) NULL DEFAULT NULL AFTER `balance`,
ADD COLUMN `card_cvv` VARCHAR(3) NULL DEFAULT NULL AFTER `card_number`,
ADD COLUMN `card_expiry` VARCHAR(7) NULL DEFAULT NULL AFTER `card_cvv`,
ADD COLUMN `card_status` ENUM('none', 'pending', 'active', 'blocked') DEFAULT 'none' AFTER `card_expiry`,
ADD COLUMN `card_issued_at` TIMESTAMP NULL DEFAULT NULL AFTER `card_status`,
ADD UNIQUE KEY `unique_card_number` (`card_number`);
```

### Step 2: Test the Feature

1. **Login to your dashboard**
2. **You should see the "Apply for Card" section**
3. **Click "Apply for Card" button**
4. **Card will be generated and page will reload**
5. **You'll now see your virtual ATM card!**

## File Changes Made

### New Files Created:
1. `config/migrations/add_card_fields.sql` - Database migration
2. `app/handlers/apply_card.php` - Card application handler
3. `CARD_FEATURE_README.md` - This file

### Modified Files:
1. `includes/components/atm_card.php` - Complete card UI
2. `config/functions/utilities.php` - Added card generation functions
3. `public/assets/css/dash.css` - Added card styling
4. `public/assets/js/dash.js` - Added card functionality
5. `includes/toggler.php` - Added card visibility toggle
6. `dashboard.php` - Included atm_card component

## How It Works

### Card Application Flow:
1. User clicks "Apply for Card"
2. JavaScript sends POST request to `app/handlers/apply_card.php`
3. Backend generates unique 16-digit card number using Luhn algorithm
4. Generates CVV and expiry date
5. Updates database with card details
6. Returns success response
7. Page reloads to show the new card

### Card Number Generation:
- **BIN (Bank Identification Number)**: 522410 (first 6 digits)
- **Account Number**: 9 random digits
- **Check Digit**: 1 digit calculated using Luhn algorithm
- **Total**: 16 digits

### Card Display:
- Beautiful gradient purple card design
- Shows bank name "D'bag Bank"
- Displays card type (DEBIT)
- Shows chip graphic
- Card number with toggle visibility
- Cardholder name (user's full name)
- Expiry date (MM/YYYY format)
- CVV masked as ***
- Mastercard logo

## Utility Functions Added

### `generate_card_number()`
Generates a valid 16-digit card number using Luhn algorithm.

### `calculate_luhn_checksum($number)`
Calculates the Luhn check digit for card validation.

### `generate_cvv()`
Generates a random 3-digit CVV.

### `generate_card_expiry()`
Generates expiry date 5 years from current date in MM/YYYY format.

## Security Considerations

1. **Card Number Masking**: By default, only last 4 digits visible
2. **Unique Constraint**: Database ensures no duplicate card numbers
3. **Session Management**: Visibility preferences saved per session
4. **Authentication**: Only logged-in users can apply for cards
5. **One Card Per User**: Users can only have one active card

## Future Enhancements (Optional)

- [ ] Add card freeze/unfreeze functionality
- [ ] Allow card blocking
- [ ] Add card replacement feature
- [ ] Show transaction history specific to card
- [ ] Add card PIN management
- [ ] Email notification on card issue
- [ ] Multiple card support (different card types)
- [ ] Virtual card for online payments only

## Testing Checklist

- [ ] Run database migration successfully
- [ ] Login to dashboard
- [ ] See "Apply for Card" button
- [ ] Click apply and receive card
- [ ] Verify card displays correctly
- [ ] Toggle card number visibility works
- [ ] Card details are correct
- [ ] Try applying again (should fail - already have card)
- [ ] Check database for card details

## Support

If you encounter any issues:
1. Check database migration ran successfully
2. Verify all files are in correct locations
3. Check browser console for JavaScript errors
4. Verify PHP error logs

---

**Enjoy your new ATM card feature! 🎉💳**
