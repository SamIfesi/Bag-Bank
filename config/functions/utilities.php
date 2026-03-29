<?php

function old_value(string $word): string
{
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST[$word])) {
    return htmlspecialchars($_POST[$word]);
  }

  // Repopulate from session after a validation-fail redirect
  if (isset($_SESSION['old_input'][$word])) {
    return htmlspecialchars($_SESSION['old_input'][$word]);
  }

  return '';
}

function is_empty(mixed $value): bool
{
  return !isset($value) || trim((string) $value) === '';
}

/**
 *
 * @param string[] $required_fields  List of field names that must be present.
 * @param array    $user_inputs      Associative array of submitted values (typically $_POST).
 * @param array    &$errors          Errors array populated by reference.
 */

function check_empty_fields(array $required_fields, array $user_inputs, array &$errors): void
{
  foreach ($required_fields as $field) {
    if (!isset($user_inputs[$field]) || trim((string) $user_inputs[$field]) === '') {
      $label = ucfirst(str_replace(['_', '-'], ' ', $field));
      $errors[] = "$label is required";
    }
  }
}

function sanitize_input(string $data): string
{
  return htmlspecialchars(strip_tags($data));
}

function is_safe_password(string $password): bool
{
  $pattern = "/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/";
  return (bool) preg_match($pattern, $password);
}

function is_email(string $email): bool
{
  return (bool) filter_var($email, FILTER_VALIDATE_EMAIL);
}

function is_match(mixed $value1, mixed $value2): bool
{
  return $value1 === $value2;
}

/**
 * Generate a unique 10-digit account number with a fixed "103" prefix.
 * Retries until the number does not already exist in the users table.
 */
function generate_account_number(): string
{
  do {
    $account_number = '103' . str_pad(random_int(0, 9999999), 7, '0', STR_PAD_LEFT);
  } while (Model::find('users', 'account_number', $account_number));

  return $account_number;
}

/**
 * Generate a valid 16-digit card number using the Luhn algorithm.
 * BIN prefix: 522410 (first 6 digits).
 */
function generate_card_number(): string
{
  $bin = '522410';

  // 9 random middle digits
  $middle = '';
  for ($i = 0; $i < 9; $i++) {
    $middle .= random_int(0, 9);
  }

  $partial = $bin . $middle;          // 15 digits
  $check = calculate_luhn_checksum($partial);

  return $partial . $check;             // 16 digits
}

/**
 * Calculate the Luhn check digit for a numeric string of length N.
 * Pass the first N-1 digits; returns the single check digit (0–9).
 */
function calculate_luhn_checksum(string $number): int
{
  $sum = 0;
  $num_digits = strlen($number);
  $parity = $num_digits % 2;

  for ($i = 0; $i < $num_digits; $i++) {
    $digit = (int) $number[$i];

    if ($i % 2 === $parity) {
      $digit *= 2;
    }

    if ($digit > 9) {
      $digit -= 9;
    }

    $sum += $digit;
  }

  return (10 - ($sum % 10)) % 10;
}

/**
 * Generate a zero-padded 3-digit CVV string (e.g. "007", "342").
 */
function generate_cvv(): string
{
  return str_pad((string) random_int(0, 999), 3, '0', STR_PAD_LEFT);
}

/**
 * Generate a card expiry date 5 years from today in MM/YYYY format.
 */
function generate_card_expiry(): string
{
  return (new DateTime('+5 years'))->format('m/Y');
}

/**
 * Issue a Location redirect and halt execution.
 */
function redirect_to(string $location): never
{
  header("Location: $location");
  exit();
}

/**
 * Returns true when a valid user session is active.
 */
function is_logged_in(): bool
{
  return isset($_SESSION['user']) && !empty($_SESSION['user']);
}
