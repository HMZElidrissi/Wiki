<?php

namespace App\Repository;

use Core\Database;

class Repository
{
    protected $db;
    protected $table;
    protected $class;
    protected $conditions;

    public function __construct($class, $table, $conditions = []) {
        $this->db = Database::getInstance();
        $this->class = $class;
        $this->table = $table;
        $this->conditions = $conditions;
    }

    public function all()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
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
        $values = array_values($data);
        $columns = implode(',', $columns);
        $values = implode(',', array_map(function ($value) {
            return "'$value'";
        }, $values));
        $this->db->query("INSERT INTO $this->table ($columns) VALUES ($values)");
        return $this->db->execute();
    }

    public function update($id, $data)
    {

    }

    public function delete($id)
    {

    }
}