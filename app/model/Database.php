<?php

class Database
{
    protected PDO $pdo;

    public function __construct()
    {
        $host = $_ENV['DB_HOST'] ?? 'switchyard.proxy.rlwy.net';
        $port = $_ENV['DB_PORT'] ?? 28712;
        $db   = $_ENV['DB_NAME'] ?? 'railway';
        $user = $_ENV['DB_USER'] ?? 'root';
        $pass = $_ENV['DB_PASS'] ?? 'xMrXpkbEskhUgfagrbAQJBgOdUmucUce';

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
