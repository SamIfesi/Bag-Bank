<?php

require_once __DIR__ . '/../../config/env.php';

class Database
{
    protected PDO $pdo;

    public function __construct()
    {
        // Use getenv() to read Railway's environment variables
        $host = getenv('MYSQL_HOST') ?: 'localhost';
        $port = getenv('MYSQL_PORT') ?: 3306;
        $db   = getenv('MYSQL_DATABASE') ?: 'mob_bank';
        $user = getenv('MYSQL_USER') ?: 'root';
        $pass = getenv('MYSQL_PASSWORD') ?: '';

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
