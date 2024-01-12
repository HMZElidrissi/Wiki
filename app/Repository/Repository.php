<?php

namespace App\Repository;

use Core\Database;

class Repository
{
    protected $db;
    protected $table;
    protected $class;
    protected $conditions;

    public function __construct($class, $table) {
        $this->db = Database::getInstance();
        $this->class = $class;
        $this->table = $table;
    }

    public function getLastInsertedId()
    {
        return $this->db->getLastInsertedId();
    }

    public function all($conditions = [])
    {
        $query = 'SELECT * FROM ' . $this->table;
        if (!empty($conditions)) {
            $columns = array_keys($conditions);
            $placeholders = array_map(function ($column) {
                return "$column = :$column";
            }, $columns);
            $placeholdersString = implode(' AND ', $placeholders);
            $query = 'SELECT * FROM ' . $this->table . ' WHERE ' . $placeholdersString;
        }
        $this->db->query($query);

        if (!empty($conditions)) {
            foreach ($conditions as $column => $value) {
                $this->db->bind(":$column", $value);
            }
        }

        $results = $this->db->fetchAllRecords();

        $objects = [];
        foreach ($results as $result) {
            $object = new $this->class();
            $properties = get_class_vars($this->class);
            foreach ($properties as $property => $value) {
                $object->$property = $result->$property;
            }
            $objects[] = $object;
        }
        return $objects;
    }

    public function search($search, $searchColumns = [])
    {
        $searchConditions = array_map(function($column) {
            return "$column LIKE :search";
        }, $searchColumns);

        $searchConditionsString = implode(' OR ', $searchConditions);

        $query = 'SELECT * FROM ' . $this->table . ' WHERE ' . $searchConditionsString;
        $this->db->query($query);
        $this->db->bind(':search', '%' . $search . '%');

        $results = $this->db->fetchAllRecords();

        $objects = [];
        foreach ($results as $result) {
            $object = new $this->class();
            $properties = get_class_vars($this->class);
            foreach ($properties as $property => $value) {
                $object->$property = $result->$property;
            }
            $objects[] = $object;
        }
        return $objects;
    }


    public function find($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id = :id');
        $this->db->bind(':id', $id);
        $result = $this->db->fetchSingleRecord();

        $object = new $this->class();
        $properties = get_class_vars($this->class);
        foreach ($properties as $property => $value) {
            $object->$property = $result->$property;
        }
        return $object;
    }

    public function create($data)
    {
        $columns = array_keys($data);
        $placeholders = array_map(function ($column) {
            return ":$column";
        }, $columns);

        $columnsString = implode(',', $columns);
        $placeholdersString = implode(',', $placeholders);

        $this->db->query("INSERT INTO $this->table ($columnsString) VALUES ($placeholdersString)");

        foreach ($data as $column => $value) {
            $this->db->bind(":$column", $value);
        }

        return $this->db->execute();
    }

    public function update($id, $data)
    {
        $columns = array_keys($data);
        $placeholders = array_map(function ($column) {
            return "$column = :$column";
        }, $columns);

        $placeholdersString = implode(',', $placeholders);

        $this->db->query("UPDATE $this->table SET $placeholdersString WHERE id = :id");
        $this->db->bind(':id', $id);
        foreach ($data as $column => $value) {
            $this->db->bind(":$column", $value);
        }

        return $this->db->execute();
    }

    public function delete($id)
    {
        $this->db->query("DELETE FROM $this->table WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}