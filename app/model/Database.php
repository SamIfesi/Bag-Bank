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

    // echo "Migrating table: $table\n";

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
// echo "Data migration completed successfully.\n";

class Database
{
    private $host = "localhost";
    private $user = "samrose";
    private $password = "password";
    private $database = "mob_bank";
    private $charset = "utf8mb4";
    protected $pdo;
    private $error;

    public function __construct()
    {
        $dns = "mysql:host=$this->host;
        dbname=$this->database;
        charset=$this->charset";
        try {
            $this->pdo = new PDO($dns, $this->user, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            header("Content-Type: application/json");
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Database connection failed.' . $e->getMessage()
            ]);
            exit;
        }
    }
    public function getPdo()
    {
        return $this->pdo;
    }
}
