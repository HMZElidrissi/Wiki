<?php

namespace App\Controllers\Admin;

use App\Repository\WikiRepository;
use App\Controllers\Controller;

class WikiController extends Controller
{
    public function __construct()
    {
        parent::__construct(WikiRepository::class);
    }

    public function display()
    {
        $data = $this->repository->all(['is_archived' => 0]);
        $config = [
            'cols' => ['image', 'title', 'description', 'created_at', 'author', 'category', 'tags', 'archive'],
            'route' => 'wikis'
        ];
        $this->render('backOffice/crudViews/show', compact('data', 'config'));
    }

    public function archive()
    {
        $this->repository->archive($_POST['id']);
        header('Location: /wikis/archived');
    }

    public function restore()
    {
        $this->repository->restore($_POST['id']);
        header('Location: /wikis/display');
    }

    public function archived()
    {
        $data = $this->repository->all(['is_archived' => 1]);
        $config = [
            'cols' => ['image', 'title', 'description', 'created_at', 'author', 'category', 'tags', 'restore'],
            'route' => 'wikis'
        ];
        $this->render('backOffice/crudViews/show', compact('data', 'config'));
    }
}