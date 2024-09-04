<?php

namespace Core\Database;

use PDO;
use PDOException;

class Database
{
    private $pdo;

    public function __construct()
    {
        $host = $_ENV['DB_HOST'];
        $db   = $_ENV['DB_DATABASE'];
        $user = $_ENV['DB_USERNAME'];
        $pass = $_ENV['DB_PASSWORD'];

        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Could not connect to the database $db :" . $e->getMessage());
        }
    }

    public function getPdo()
    {
        return $this->pdo;
    }
}
