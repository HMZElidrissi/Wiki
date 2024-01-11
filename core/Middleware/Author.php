<?php

namespace Core\Middleware;

class Author
{
    public function handle()
    {
        if ($_SESSION['role'] != 'author') {
            abort(403);
            exit();
        }
    }
}