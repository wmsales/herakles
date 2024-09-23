<?php

use Config\Database;

class Model
{
    public $db;
    public function __construct()

    {
        $this->db = new Database();
    }
    
    public function all($table, $parameter = [], $orderBy = [])
    {
        if (empty($parameter)) {
            $consulta = "SELECT * FROM $table";
        } else {
            $fields = [];
            $params = [];

            foreach ($parameter as $field => $value) {
                if (is_array($value)) {
                    $placeholders = implode(', ', array_fill(0, count($value), '?'));
                    $fields[] = "$field IN ($placeholders)";
                    $params = array_merge($params, $value);
                } else {
                    $fields[] = "$field = :$field";
                    $params[":$field"] = $value;
                }
            }

            $whereClause = implode(' AND ', $fields);
            $consulta = "SELECT * FROM $table WHERE $whereClause";
        }

        if (!empty($orderBy)) {
            $orderFields = [];
            foreach ($orderBy as $field => $direction) {
                $direction = strtoupper($direction) === 'DESC' ? 'DESC' : 'ASC';
                $orderFields[] = "$field $direction";
            }
            $orderClause = implode(', ', $orderFields);
            $consulta .= " ORDER BY $orderClause";
        }

        $resultado = $this->db->query($consulta, $params);
        $array = [];
        foreach ($resultado as $row) {
            $array[] = $row;
        }
        return $array;
    }

    public function find($table, $id)
    {
        $consulta = "SELECT * FROM $table WHERE id = :id";
        return $this->db->query($consulta, ['id' => $id]);
    }
    public function store($table, $parameter = [])
    {
        $fields = [];
        $placeholders = [];
        foreach ($parameter as $field => $value) {
            $fields[] = $field;
            $placeholders[] = ":$field";
        }
        $fieldList = implode(', ', $fields);
        $placeholderList = implode(', ', $placeholders);
        $consulta = "INSERT INTO $table ($fieldList) VALUES ($placeholderList)";
        return $this->db->execute($consulta, $parameter);
    }
    public function update($table, $id, $parameter = [])
    {
        $fields = [];
        foreach ($parameter as $field => $value) {
            $fields[] = "$field = :$field";
        }
        $fieldList = implode(', ', $fields);
        $consulta = "UPDATE $table SET $fieldList WHERE id = :id";
        $parameter['id'] = $id;
        return $this->db->execute($consulta, $parameter);
    }
    public function destroy($table, $id)
    {
        $consulta = "DELETE FROM $table WHERE id = :id";
        return $this->db->execute($consulta, ['id' => $id]);
    }
}
