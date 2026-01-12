<?php

ini_set('memory_limit', '1024M');
set_time_limit(0);

function connectPDO($host, $port, $db, $user, $pass)
{
    $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";
    return new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false
    ]);
}

// SOURCE (Local DB)
$sourcePDO = connectPDO(
    "localhost",
    3306,
    "mob_bank",
    "samrose",
    "password"
);

// DESTINATION (Online DB – Railway)
$destPDO = connectPDO(
    "switchyard.proxy.rlwy.net",
    28712,
    "railway",
    "root",
    "xMrXpkbEskhUgfagrbAQJBgOdUmucUce"
);

$destPDO->exec("SET FOREIGN_KEY_CHECKS=0");

$tables = $sourcePDO->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
foreach ($tables as $table) {
    // 1. Get CREATE TABLE statement
    $createTableSQL = $sourcePDO
        ->query("SHOW CREATE TABLE `$table`")
        ->fetch(PDO::FETCH_ASSOC)['Create Table'];

    // 2. Drop table if exists in destination
    $destPDO->exec("DROP TABLE IF EXISTS `$table`");

    // 3. Create table in destination
    $destPDO->exec($createTableSQL);

    // 4. Fetch data from source table
    $rows = $sourcePDO->query("SELECT * FROM `$table`")->fetchAll();

    if (count($rows) === 0) {
        continue;
    }

    // 5. Prepare INSERT statement
    $columns = array_keys($rows[0]);
    $columnList = "`" . implode("`,`", $columns) . "`";
    $placeholders = ":" . implode(",:", $columns);

    $insertSQL = "INSERT INTO `$table` ($columnList) VALUES ($placeholders)";
    $stmt = $destPDO->prepare($insertSQL);

    // 6. Insert rows using transaction
    $destPDO->beginTransaction();

    foreach ($rows as $row) {
        $stmt->execute($row);
    }

    $destPDO->commit();
}
$destPDO->exec("SET FOREIGN_KEY_CHECKS=1");

class Database
{
    protected PDO $pdo;

    private string $host = "switchyard.proxy.rlwy.net";
    private string $user = "root";
    private string $password = "xMrXpkbEskhUgfagrbAQJBgOdUmucUce";
    private string $database = "railway";
    private int $port = 28712;
    private string $charset = "utf8mb4";

    public function __construct()
    {
        $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->database};charset={$this->charset}";

        try {
            $this->pdo = new PDO(
                $dsn,
                $this->user,
                $this->password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]
            );
        } catch (PDOException $e) {
            throw new RuntimeException(
                "Database connection failed: " . $e->getMessage()
            );
        }
    }

    public function getPdo(): PDO
    {
        return $this->pdo;
    }
}