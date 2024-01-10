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

    public function show()
    {
        $wikis = $this->repository->all();
        $config = [
            'cols' => ['image', 'title', 'description', 'created_at', 'author', 'category', 'tags', 'archive'],
            'route' => 'wikis'
        ];
        $this->render('backOffice/wikis/show', compact('wikis', 'config'));
    }
}