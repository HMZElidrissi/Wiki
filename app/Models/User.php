<?php

namespace App\Models;

use Core\Database;

abstract class User
{
    public string $name;
    public string $email;
    public string $password;
    public string $role;

    public function new(string $name, string $email, string $password, string $role)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}