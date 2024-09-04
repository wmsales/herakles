<?php

namespace Core\Database;

use PDO;

abstract class Model
{
    protected $pdo;
    protected $table;
    protected $primaryKey = 'id';

    public function __construct()
    {
        $this->pdo = (new Database())->getPdo();
    }

    public function all()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table}");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function find($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE {$this->primaryKey} = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function create($data)
    {
        $columns = implode(", ", array_keys($data));
        $placeholders = implode(", ", array_fill(0, count($data), '?'));

        $stmt = $this->pdo->prepare("INSERT INTO {$this->table} ($columns) VALUES ($placeholders)");
        return $stmt->execute(array_values($data));
    }

    public function update($id, $data)
    {
        $set = "";
        foreach ($data as $column => $value) {
            $set .= "$column = ?, ";
        }
        $set = rtrim($set, ", ");

        $stmt = $this->pdo->prepare("UPDATE {$this->table} SET $set WHERE {$this->primaryKey} = ?");
        return $stmt->execute(array_merge(array_values($data), [$id]));
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM {$this->table} WHERE {$this->primaryKey} = ?");
        return $stmt->execute([$id]);
    }
}
