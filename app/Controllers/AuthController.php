<?php

namespace App\Controllers;

use App\Models\Admin;

class AuthController extends Controller
{
    private $model;

    public function __construct() {
        $this->model = new Admin();
    }

    public function login()
    {
        // login logic
    }
    public function register()
    {
        if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
            // Gérer l'erreur
        }
        $data = [
            'name' => htmlspecialchars($_POST['name']),
            'email' => htmlspecialchars($_POST['email']),
            'password' => htmlspecialchars($_POST['password']),
        ];
        if ($this->model->register($data, 'author')) {
            header('Location: /login');
        } else {
            die('Something went wrong');
        }
    }
}