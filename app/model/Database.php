<?php

require_once __DIR__ . '/../../config/env.php';

class Database
{
  protected PDO $pdo;

  private function envFirst(array $keys, ?string $default = null): ?string
  {
    foreach ($keys as $key) {
      $value = getenv($key);
      if ($value === false && isset($_ENV[$key])) {
        $value = $_ENV[$key];
      }

      if ($value !== false && $value !== null && $value !== '') {
        return (string) $value;
      }
    }

    return $default;
  }

  private function parseMysqlUrl(string $url): array
  {
    $parts = parse_url($url);
    if ($parts === false) {
      return [];
    }

    $path = $parts['path'] ?? '';
    $dbName = ltrim($path, '/');

    return [
      'host' => $parts['host'] ?? null,
      'port' => isset($parts['port']) ? (string) $parts['port'] : null,
      'db' => $dbName !== '' ? $dbName : null,
      'user' => $parts['user'] ?? null,
      'pass' => $parts['pass'] ?? null,
    ];
  }

  public function __construct()
  {
    // Railway uses MYSQLHOST (no underscore). Try both.
    $host = getenv('MYSQLHOST') ?: getenv('MYSQL_HOST') ?: 'localhost';
    $port = getenv('MYSQLPORT') ?: getenv('MYSQL_PORT') ?: 3306;
    $db   = getenv('MYSQLDATABASE') ?: getenv('MYSQL_DATABASE') ?: 'railway';
    $user = getenv('MYSQLUSER') ?: getenv('MYSQL_USER') ?: 'root';
    $pass = getenv('MYSQLPASSWORD') ?: getenv('MYSQL_PASSWORD') ?: '';

    $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";

    $this->pdo = new PDO($dsn, $user, $pass, [
      PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
      PDO::ATTR_EMULATE_PREPARES   => false,
    ]);

    $this->ensureSchema($db);
  }

  private function ensureSchema(string $dbName): void
  {
    $autoImport = getenv('AUTO_SCHEMA_IMPORT') ?: '1';
    if ($autoImport !== '1') {
      return;
    }

    if ($this->tableExists($dbName, 'users')) {
      return;
    }

    $schemaPath = __DIR__ . '/../../schema.sql';
    if (!file_exists($schemaPath)) {
      return;
    }

    $sql = file_get_contents($schemaPath);
    if ($sql === false) {
      return;
    }

    $this->pdo->exec($sql);
  }

  private function tableExists(string $dbName, string $tableName): bool
  {
    $stmt = $this->pdo->prepare(
      'SELECT 1 FROM information_schema.tables WHERE table_schema = :db AND table_name = :table LIMIT 1'
    );
    $stmt->execute([
      ':db' => $dbName,
      ':table' => $tableName,
    ]);

    return (bool) $stmt->fetchColumn();
  }

  public function getPdo(): PDO
  {
    return $this->pdo;
  }
}
