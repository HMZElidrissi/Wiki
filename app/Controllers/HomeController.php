<?php

namespace App\Controllers;
use App\Repository\WikiRepository;
use App\Services\RenderWikis;

class HomeController extends Controller
{
    public function __construct()
    {
        parent::__construct(WikiRepository::class);
    }
    public function index(): void
    {
        $wikis = $this->repository->all(['is_archived' => 0]);
        $this->render('frontOffice/home', compact('wikis'));
    }

    public function show(): void
    {
        $id = $_GET['id'];
        $wiki = $this->repository->find($id);
        $this->render('frontOffice/wiki', compact('wiki'));
    }

    public function latest()
    {
        $wikis = $this->repository->latest();
        $this->render('frontOffice/latest', compact('wikis'));
    }

    public function dashboard(): void
    {
        $stats = $this->repository->getStats();
        $this->render('backOffice/dashboard', compact('stats'));
    }

    public function login(): void
    {
        $_SESSION['errors'] = [];
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        $this->render('auth/login');
    }

    public function register(): void
    {
        $_SESSION['errors'] = [];
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        $this->render('auth/register');
    }

    public function error($code): void
    {
        $this->render('errors/'.$code);
    }

    public function search(): void
    {
        $search = $_POST['searchInput'];
        $wikis = $this->repository->search($search, ['title', 'description', 'content'], ['is_archived' => 0]);
        echo RenderWikis::renderAll($wikis);
    }
}