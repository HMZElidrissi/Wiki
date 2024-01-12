<?php

namespace App\Repository;

use App\Models\User;

class UserRepository extends Repository
{
    public function __construct()
    {
        parent::__construct(User::class, 'users');
    }

    public function register($data, $role): bool
    {
        $this->db->query('INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, :role)');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', password_hash($data['password'], PASSWORD_DEFAULT));
        $this->db->bind(':role', $role);
        return $this->db->execute();
    }

    public function login($email, $password): object|bool
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