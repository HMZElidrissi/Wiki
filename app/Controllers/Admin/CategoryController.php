<?php

namespace App\Controllers\Admin;

use App\Repository\CategoryRepository;
use App\Controllers\Controller;

class CategoryController extends Controller
{
    public function __construct()
    {
        parent::__construct(CategoryRepository::class);
    }

    public function show(): void
    {
        $data = $this->repository->all();
        $config = [
            'add' => [
                'route' => '/categories/create',
                'title' => '+ Ajouter une catégorie'
            ],
            'cols' => ['title', 'description', 'update', 'delete'],
            'route' => 'categories'
        ];
        $this->render('backOffice/crudViews/show', compact('data', 'config'));
    }

    public function create(): void
    {
        $config = [
            'route' => '/categories',
            'action' => '/categories/store',
            'method' => 'POST',
            'fields' => [
                [
                    'name' => 'title',
                    'type' => 'text',
                    'label' => 'Titre de la catégorie'
                ],
                [
                    'name' => 'description',
                    'type' => 'textarea',
                    'label' => 'Description de la catégorie'
                ]
            ]
        ];
        $this->render('backOffice/crudViews/create', compact('config'));
    }

    public function store(): void
    {
        $data = [
            'title' => $_POST['title'],
            'description' => $_POST['description']
        ];
        $this->repository->create($data);
        header('Location: /categories');
    }

    public function update(): void
    {
        $category = $this->repository->find($_POST['id']);
        $config = [
            'route' => '/categories',
            'action' => '/categories/edit',
            'method' => 'POST',
            'fields' => [
                [
                    'name' => 'id',
                    'type' => 'hidden',
                    'value' => $category->id
                ],
                [
                    'name' => 'title',
                    'type' => 'text',
                    'label' => 'Titre de la catégorie'
                ],
                [
                    'name' => 'description',
                    'type' => 'textarea',
                    'label' => 'Description de la catégorie'
                ]
            ]
        ];
        $data = [
            'title' => $category->title,
            'description' => $category->description
        ];
        $this->render('backOffice/crudViews/update', compact('config', 'data'));
    }

    public function edit(): void
    {
        $id = $_POST['id'];
        $data = [
            'title' => $_POST['title'],
            'description' => $_POST['description']
        ];
        $this->repository->update($id, $data);
        header('Location: /categories');
    }

    public function delete(): void
    {
        $this->repository->delete($_POST['id']);
        header('Location: /categories');
    }
}