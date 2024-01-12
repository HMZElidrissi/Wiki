<?php

namespace App\Controllers\Admin;

use App\Repository\TagRepository;
use App\Controllers\Controller;

class TagController extends Controller
{
    public function __construct()
    {
        parent::__construct(TagRepository::class);
    }

    public function show(): void
    {
        $data = $this->repository->all();
        $config = [
            'add' => [
                'route' => '/tags/create',
                'title' => '+ Ajouter un tag'
            ],
            'cols' => ['title', 'update', 'delete'],
            'route' => 'tags'
        ];
        $this->render('backOffice/crudViews/show', compact('data', 'config'));
    }

    public function create(): void
    {
        $config = [
            'route' => '/tags',
            'action' => '/tags/store',
            'method' => 'POST',
            'fields' => [
                [
                    'name' => 'title',
                    'type' => 'text',
                    'label' => 'Titre du tag'
                ]
            ]
        ];
        $this->render('backOffice/crudViews/create', compact('config'));
    }

    public function store(): void
    {
        $data = [
            'title' => $_POST['title']
        ];
        $this->repository->create($data);
        header('Location: /tags');
    }

    public function update(): void
    {
        $tag = $this->repository->find($_POST['id']);
        $config = [
            'route' => '/tags',
            'action' => '/tags/edit',
            'method' => 'POST',
            'fields' => [
                [
                    'name' => 'id',
                    'type' => 'hidden',
                    'value' => $tag->id
                ],
                [
                    'name' => 'title',
                    'type' => 'text',
                    'label' => 'Titre du tag',
                ]
            ]
        ];
        $data = [
            'title' => $tag->title
        ];
        $this->render('backOffice/crudViews/update', compact('config', 'data'));
    }

    public function edit(): void
    {
        $id = $_POST['id'];
        $data = [
            'title' => $_POST['title']
        ];
        $this->repository->update($id, $data);
        header('Location: /tags');
    }

    public function delete(): void
    {
        $this->repository->delete($_POST['id']);
        header('Location: /tags');
    }
}