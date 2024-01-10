<?php

namespace Core\Middleware;

class Author
{
    public function handle()
    {
        if ($_SESSION['role'] != 'author') {
            header('location: /');
            exit();
        }
    }
}