<?php
// Get last 4 transactions for the logged-in user
$user_id = $user->id;
$db = new Database();
$stmt = $db->getPdo()->prepare("SELECT * FROM transactions WHERE user_id = ? ORDER BY created_at DESC LIMIT 4");
$stmt->execute([$user_id]);
$transactions = $stmt->fetchAll();
?>