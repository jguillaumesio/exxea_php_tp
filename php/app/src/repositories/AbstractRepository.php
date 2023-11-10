<?php

namespace App\repositories;

abstract class AbstractRepository
{
    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    abstract protected function getTableName(): string;

    public function findById(int $id)
    {
        $table = $this->getTableName();
        $query = $this->db->prepare("SELECT * FROM $table WHERE id = :id");
        $query->bindParam(':id', $id, \PDO::PARAM_INT);
        $query->execute();
        return $query->fetch(\PDO::FETCH_ASSOC);
    }

    public function findAll()
    {
        $table = $this->getTableName();
        $query = $this->db->query("SELECT * FROM $table");
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function updateById(int $id, array $data)
    {
        $table = $this->getTableName();
        $fields = '';
        foreach ($data as $key => $value) {
            $fields .= "$key = :$key, ";
        }
        $fields = rtrim($fields, ', ');

        $query = $this->db->prepare("UPDATE $table SET $fields WHERE id = :id");
        $query->bindParam(':id', $id, \PDO::PARAM_INT);
        foreach ($data as $key => $value) {
            $query->bindParam(":$key", $value);
        }
        return $query->execute();
    }

    public function create(array $data)
    {
        $table = $this->getTableName();
        $fields = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));

        $query = $this->db->prepare("INSERT INTO $table ($fields) VALUES ($placeholders)");
        foreach ($data as $key => $value) {
            $query->bindParam(":$key", $value);
        }
        return $query->execute();
    }

    public function remove(int $id)
    {
        $table = $this->getTableName();
        $query = $this->db->prepare("DELETE FROM $table WHERE id = :id");
        $query->bindParam(':id', $id, \PDO::PARAM_INT);
        return $query->execute();
    }
}
