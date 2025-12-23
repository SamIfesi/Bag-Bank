<?php
session_start();
require_once __DIR__ . "/../../config/functions/utilities.php";
require_once __DIR__ . "/../../config/Auth.php";

// Check if user is logged in
if (!is_logged_in()) {
    header("Content-Type: application/json");
    http_response_code(401);
    echo json_encode([
        'success' => false,
        'message' => 'Unauthorized access'
    ]);
    exit();
}

// Check if request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Content-Type: application/json");
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'message' => 'Method not allowed'
    ]);
    exit();
}

try {
    $user = Auth::user();

    // Check if user already has a card
    if ($user->card_status !== 'none' && !empty($user->card_number)) {
        header("Content-Type: application/json");
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => 'You already have a card'
        ]);
        exit();
    }

    // Generate card details
    $card_number = generate_card_number();
    $cvv = generate_cvv();
    $expiry = generate_card_expiry();

    // Make sure card number is unique
    $max_attempts = 10;
    $attempts = 0;

    while (Model::find('users', 'card_number', $card_number) && $attempts < $max_attempts) {
        $card_number = generate_card_number();
        $attempts++;
    }

    if ($attempts >= $max_attempts) {
        throw new Exception('Failed to generate unique card number');
    }

    // Update user record with card details
    $card_data = [
        'card_number' => $card_number,
        'card_cvv' => $cvv,
        'card_expiry' => $expiry,
        'card_status' => 'active',
        'card_issued_at' => date('Y-m-d H:i:s')
    ];

    $updated = Model::update('users', $card_data, $user->id);

    if ($updated) {
        header("Content-Type: application/json");
        http_response_code(200);
        echo json_encode([
            'success' => true,
            'message' => 'Card issued successfully!',
            'card' => [
                'number' => $card_number,
                'expiry' => $expiry
            ]
        ]);
    } else {
        throw new Exception('Failed to issue card');
    }
} catch (Exception $e) {
    header("Content-Type: application/json");
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Error issuing card: ' . $e->getMessage()
    ]);
}
exit();
