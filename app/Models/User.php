<?php

namespace App\Models;

use Core\Database;

abstract class User
{
    protected $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function register($data, $role)
    {
        $this->db->query('INSERT INTO users (name, email, password, role_id) VALUES (:name, :email, :password, :role)');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', password_hash($data['password'], PASSWORD_DEFAULT));
        $this->db->bind(':role', $role);
        return $this->db->execute();
    }

    public function login($email, $password)
    {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);
        $this->db->execute();
        $row = $this->db->fetchSingleRecord();

        if ($row && password_verify($password, $row->password)) {
            return $row;
        }
        return false;
    }
}