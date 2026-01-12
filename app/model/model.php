<?php
require_once __DIR__ . '/Database.php';

class Model extends Database
{
    private static ?PDO $db = null;

    private static function db(): PDO
    {
        if (self::$db === null) {
            self::$db = (new self())->pdo;
        }
        return self::$db;
    }

    public static function create(string $table, array $data)
    {
        $fields = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));

        $stmt = self::db()->prepare(
            "INSERT INTO `$table` ($fields) VALUES ($placeholders)"
        );

        return $stmt->execute(array_values($data))
            ? self::db()->lastInsertId()
            : false;
    }

    public static function all($table)
    {
        $stmt = self::db()->query(
            "SELECT * FROM `$table` ORDER BY id DESC"
        );
        return $stmt->fetchAll();
    }

    public static function find($table, $col, $value)
    {
        $stmt = self::db()->prepare(
            "SELECT * FROM `$table` WHERE `$col` = ? LIMIT 1"
        );
        $stmt->execute([$value]);
        return $stmt->fetch() ?: false;
    }

    public static function update($table, $data, $id)
    {
        $fields = implode(', ', array_map(
            fn($k) => "$k = ?",
            array_keys($data)
        ));

        $stmt = self::db()->prepare(
            "UPDATE `$table` SET $fields WHERE id = ?"
        );

        return $stmt->execute([...array_values($data), $id]);
    }
}
