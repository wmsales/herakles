<?php

namespace Config;

class Database
{
    private $server;
    private $username;
    private $dbname;
    private $password;
    private $pdo;
    private $error;

    public function __construct()
    {
        if (getenv('APP_DEV')) {
            // Local
            $this->server = getenv('DB_HOST_DEV');
            $this->username = getenv('DB_USER_DEV');
            $this->password = getenv('DB_PASS_DEV');
            $this->dbname = getenv('DB_NAME_DEV');
        } else {
            // Production
            $this->server = getenv('DB_HOST_PROD');
            $this->username = getenv('DB_USER_PROD');
            $this->password = getenv('DB_PASS_PROD');
            $this->dbname = getenv('DB_NAME_PROD');
        }

        try {
            $dsn = 'mysql:host=' . $this->server . ';dbname=' . $this->dbname;
            // Usa la clase PDO nativa de PHP
            $this->pdo = new \PDO($dsn, $this->username, $this->password);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
        } catch (\PDOException $e) {
            $this->error = $e->getMessage();
            echo 'No hay conexión al servidor: ' . $this->error;
        }
    }

    public function get()
    {
        return $this->pdo;
    }

    public function query($sql, $params = [])
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function execute($sql, $params = [])
    {
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }
}
