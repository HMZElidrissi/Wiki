<?php

namespace App\Models;

use Core\Database;

class Author extends User
{
    public function __toString(): string
    {
        return $this->name;
    }
}