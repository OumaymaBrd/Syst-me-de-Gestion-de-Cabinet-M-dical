<?php

class Database {
    private static $instance = null;
    private $conn;

    private function __construct() {
        $host = 'localhost';
        $port = 3307;
        $dbname = 'cabinet_medical';
        $username = 'root';
        $password = '';

        try {
            $this->conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }
}

