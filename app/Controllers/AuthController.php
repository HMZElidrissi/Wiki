<?php

namespace App\Controllers;

use App\Repository\UserRepository;

class AuthController extends Controller
{
    public function __construct()
    {
        parent::__construct(UserRepository::class);
    }

    public function login(): void
    {
        if (hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);
            $user = $this->repository->login($email, $password);
            if ($user) {
                $_SESSION['user_id'] = $user->id;
                $_SESSION['username'] = $user->name;
                $_SESSION['role'] = $user->role;
                header('Location: /dashboard');
            } else {
                die('Something went wrong');
            }
        } else {
            abort(403);
        }
    }

    public function register(): void
    {
        if (hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
            $data = [
                'name' => htmlspecialchars($_POST['name']),
                'email' => htmlspecialchars($_POST['email']),
                'password' => htmlspecialchars($_POST['password']),
            ];
            if ($this->repository->register($data, 'author')) {
                header('Location: /login');
            } else {
                die('Something went wrong');
            }
        } else {
            abort(403);
        }
    }

    public function logout(): void
    {
        session_unset();
        session_destroy();
        header('Location: /');
    }
}