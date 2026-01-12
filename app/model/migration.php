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

// LOCAL
$sourcePDO = connectPDO(
    "localhost",
    3306,
    "mob_bank",
    "samrose",
    "password"
);

// RAILWAY
$destPDO = connectPDO(
    "switchyard.proxy.rlwy.net",
    28712,
    "railway",
    "root",
    "YOUR_PASSWORD"
);

$destPDO->exec("SET FOREIGN_KEY_CHECKS=0");

$tables = $sourcePDO->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);

foreach ($tables as $table) {
    $createTableSQL = $sourcePDO
        ->query("SHOW CREATE TABLE `$table`")
        ->fetch(PDO::FETCH_ASSOC)['Create Table'];

    $destPDO->exec("DROP TABLE IF EXISTS `$table`");
    $destPDO->exec($createTableSQL);

    $rows = $sourcePDO->query("SELECT * FROM `$table`")->fetchAll();

    if (!$rows) continue;

    $columns = array_keys($rows[0]);
    $columnList = "`" . implode("`,`", $columns) . "`";
    $placeholders = ":" . implode(",:", $columns);

    $stmt = $destPDO->prepare(
        "INSERT INTO `$table` ($columnList) VALUES ($placeholders)"
    );

    $destPDO->beginTransaction();
    foreach ($rows as $row) {
        $stmt->execute($row);
    }
    $destPDO->commit();
}

$destPDO->exec("SET FOREIGN_KEY_CHECKS=1");

echo "Migration complete\n";
