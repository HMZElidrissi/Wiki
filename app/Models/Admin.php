<?php

namespace App\Models;

use Core\Database;

class Admin extends User
{
    public function __toString(): string
    {
        return $this->name;
    }
}