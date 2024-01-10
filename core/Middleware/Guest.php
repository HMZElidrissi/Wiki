<?php

namespace Core\Middleware;

class Guest
{
    public function handle()
    {
        if ($_SESSION['user_id'] ?? false) {
            header('location: /');
            exit();
        }
    }
}