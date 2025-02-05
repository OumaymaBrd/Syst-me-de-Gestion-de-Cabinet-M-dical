<?php

namespace App\Config;

class Database
{
    private static $instance = null;
    private $conn;

    private function __construct()
    {
        $host = 'localhost';
        $db   = 'cabinet_medical';
        $pass = '';
       
        $charset = 'utf8';

        $dsn = "pgsql:host=$host;dbname=$db;apassword=$pass;charset=$charset";
        $options = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $this->conn = new \PDO($dsn, $user, $pass, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->conn;
    }
}