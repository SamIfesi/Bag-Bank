<?php

require_once __DIR__ . '/../../config/env.php';

class Database
{
    protected PDO $pdo;

    public function __construct()
    {
        // Try to read DB_* variables first (for local development)
        // Fall back to MYSQL_* variables from Railway
        $host = $_ENV['DB_HOST'] ?? $_ENV['MYSQL_HOST'] ?? 'localhost';
        $port = $_ENV['DB_PORT'] ?? $_ENV['MYSQL_PORT'] ?? 3306;
        $db   = $_ENV['DB_NAME'] ?? $_ENV['MYSQL_DATABASE'] ?? 'mob_bank';
        $user = $_ENV['DB_USER'] ?? $_ENV['MYSQL_USER'] ?? 'root';
        $pass = $_ENV['DB_PASS'] ?? $_ENV['MYSQL_PASSWORD'] ?? '';

        $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";

        $this->pdo = new PDO(
            $dsn,
            $user,
            $pass,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]
        );
    }

    public function getPdo(): PDO
    {
        return $this->pdo;
    }
}
