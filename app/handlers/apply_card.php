<?php
require_once __DIR__ . "/../../core/Config.php";
require_once ROOT . "/app/model/model.php";
require_once ROOT . "/config/functions/utilities.php";
require_once ROOT . "/config/Auth.php";

header('Content-Type: application/json');

if (!is_logged_in()) {
  http_response_code(401);
  echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
  exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(405);
  echo json_encode(['success' => false, 'message' => 'Method not allowed']);
  exit;
}

try {
  $user = Auth::user();

  if (!$user) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
    exit;
  }

  // Prevent issuing a second card
  if ($user->card_status !== 'none' && !empty($user->card_number)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'You already have a card']);
    exit;
  }

  // Generate a unique card number (max 10 attempts)
  $card_number = generate_card_number();
  $max_attempts = 10;
  $attempts = 0;

  while (Model::find('users', 'card_number', $card_number) && $attempts < $max_attempts) {
    $card_number = generate_card_number();
    $attempts++;
  }

  if ($attempts >= $max_attempts) {
    throw new RuntimeException('Failed to generate a unique card number');
  }

  // Persist card details
  $updated = Model::update('users', [
    'card_number'    => $card_number,
    'card_cvv'       => generate_cvv(),
    'card_expiry'    => generate_card_expiry(),
    'card_status'    => 'active',
    'card_issued_at' => date('Y-m-d H:i:s'),
  ], $user->id);

  if (!$updated) {
    throw new RuntimeException('Failed to save card to database');
  }

  http_response_code(200);
  echo json_encode([
    'success' => true,
    'message' => 'Card issued successfully!',
    'card'    => [
      'number' => $card_number,
      'expiry' => generate_card_expiry(),
    ],
  ]);
} catch (Exception $e) {
  error_log('apply_card error [user=' . ($_SESSION['user'] ?? 'unknown') . ']: ' . $e->getMessage());

  http_response_code(500);
  echo json_encode([
    'success' => false,
    'message' => 'Error issuing card: ' . $e->getMessage(),
  ]);
}
exit;
