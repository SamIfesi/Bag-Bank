<?php
require_once __DIR__ . '/app/model/Database.php';

try {
    $db = new Database();
    $pdo = $db->getPdo();

    // Read the schema.sql file
    // Make sure schema.sql is in the same folder or update the path
    $sql = file_get_contents(__DIR__ . '/schema.sql');

    if (!$sql) {
        die("Error: Could not find schema.sql");
    }

    $pdo->exec($sql);
    echo "Database schema imported successfully!";
} catch (Exception $e) {
    echo "Error importing schema: " . $e->getMessage();
}
