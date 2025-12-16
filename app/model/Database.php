<?php
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
