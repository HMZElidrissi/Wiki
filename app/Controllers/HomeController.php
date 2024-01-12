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

    public function showCategories(): void
    {
        $categories = $this->repository->getAllCategories();
        $this->render('frontOffice/categories', compact('categories'));
    }

    public function showTags(): void
    {
        $tags = $this->repository->getAllTags();
        $this->render('frontOffice/tags', compact('tags'));
    }

    public function dashboard(): void
    {
        $this->render('backOffice/dashboard');
    }

    public function login(): void
    {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        $this->render('auth/login');
    }

    public function register(): void
    {
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