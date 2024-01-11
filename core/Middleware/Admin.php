<?php

namespace Core\Middleware;

class Admin
{
    public function handle()
    {
        if ($_SESSION['role'] != 'admin') {
            abort(403);
            exit();
        }
    }
}