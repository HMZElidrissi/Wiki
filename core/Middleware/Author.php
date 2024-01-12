<?php

namespace Core\Middleware;

class Author
{
    public function handle(): void
    {
        if ($_SESSION['role'] != 'author') {
            abort(403);
            exit();
        }
    }
}