<?php

namespace App\Controllers;

class Controller
{
    public function __construct($repository)
    {
        $this->repository = new $repository();
    }
    protected function render($view, $data = [])
    {
        extract($data);
        require_once __DIR__ . "/../../views/$view.php";
    }
}