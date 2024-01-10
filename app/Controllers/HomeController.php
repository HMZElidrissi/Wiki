<?php

namespace App\Controllers;
use App\Repository\WikiRepository;

class HomeController extends Controller
{
    public function __construct()
    {
        parent::__construct(WikiRepository::class);
    }
    public function index()
    {
        $wikis = $this->repository->all();
        $this->render('frontOffice/home', compact('wikis'));
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
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        $this->render('auth/register');
    }
}