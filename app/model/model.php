<?php
require_once(__DIR__ . '/Database.php');
class Model extends Database {

    public static function create (string $table, array $data){
        $fields = implode(', ', array_keys($data));
        $values = array_values($data);
        
        $placeholder = "";   
        $placeholder = implode(', ', array_fill(0, count($values), '?'));
        $instance = new self;
        $stmt = $instance->pdo->prepare("INSERT INTO $table ($fields) VALUES ($placeholder)");
        if($stmt->execute($values)){
            return $instance->pdo->lastInsertId();
        }
        return false;
    }

    public static function all($table){
        $sql = "SELECT * FROM $table ORDER BY `id` DESC";
        $instance = new self;
        $stmt = $instance->pdo->query($sql);
        $data = $stmt->fetchAll();
        return $data;
    }

    public static function find($table, $col, $value){
        $sql = "SELECT * FROM $table WHERE $col = ?";
        $instance = new self;
        $stmt = $instance->pdo->prepare($sql);
        $stmt->execute([$value]);
        $result = $stmt->fetch();
        return $result ? $result : false;
    }
    public static function update($table, $data, $id){
        $fields = "";
        foreach($data as $key => $value){
            $fields .= "$key = ?, ";
        }
        $fields = rtrim($fields, ', ');
        $sql = "UPDATE $table SET $fields WHERE id = ?";
        $values = array_values($data);
        $values[] = $id;

        $instance = new self;
        $stmt = $instance->pdo->prepare($sql);
        return $stmt->execute($values);
    }
}