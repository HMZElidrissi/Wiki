<?php

namespace App\Controllers;

class HomeController extends Controller
{
    public function home()
    {
        $this->render('frontOffice/home');
    }

    public function dashboard()
    {
        $this->render('backOffice/dashboard');
    }

    public function login()
    {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        $this->render('auth/login');
    }

    public function register()
    {
        $this->render('auth/register');
    }
}