<?php

class DatabaseConnector {

    private $dbConnection = null;

    public function __construct()
    {
        $host = 'localhost';
        $db   = 'games';
        $user = 'root';
        $pass = '';

        try {
            $this->dbConnection = new \PDO(
                "mysql:host=$host;charset=utf8mb4;dbname=$db", $user, $pass);
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->dbConnection;
    }
}