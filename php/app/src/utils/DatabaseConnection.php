<?php

namespace App\utils;

class DatabaseConnection
{
    private $pdo;

    public function __construct()
    {
        $config = join(DIRECTORY_SEPARATOR, [rtrim(__DIR__, DIRECTORY_SEPARATOR), './../config/db.php']);
        $dbConfig = require $config;
        $this->connect($dbConfig);
    }

    private function connect($config)
    {
        $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";

        try {
            $this->pdo = new \PDO($dsn, $config['username'], $config['password']);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->pdo;
    }
}
