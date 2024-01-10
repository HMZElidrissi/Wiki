<?php

namespace App\Models;

use Core\Database;

class Admin extends User
{
    public function __construct()
    {
        parent::__construct();
    }
}