<?php

namespace App\Controllers\Author;
use App\Repository\WikiRepository;

use App\Controllers\Controller;

class WikiController extends Controller
{
    public function __construct()
    {
        parent::__construct(WikiRepository::class);
    }

    public function show(): void
    {
        $wikis = $this->repository->all(['author_id' => $_SESSION['user_id']]);
        $config = [
            'add' => [
                'route' => '/wikis/create',
                'title' => '+ Ajouter un wiki'
            ],
            'cols' => ['image', 'title', 'description', 'created_at', 'category', 'tags', 'update', 'delete'],
            'route' => 'wikis'
        ];
        $this->render('backOffice/wikis/show', compact('wikis', 'config'));
    }

    public function store(): void
    {
        if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $imageContent = file_get_contents($_FILES['image']['tmp_name']);
        } else {
            $imageContent = null;
        }
        $data = [
            'title' => $_POST['title'],
            'image' => $imageContent,
            'description' => $_POST['description'],
            'content' => $_POST['content'],
            'category_id' => $_POST['category_id'],
            'author_id' => $_POST['author_id'],
            'is_archived' => $_POST['is_archived']
        ];
        $this->repository->create($data);
        $this->repository->addWikiTags($this->repository->getLastInsertedId(), $_POST['tags']);
        header('Location: /wikis/show');
    }

    public function create(): void
    {
        $categories = $this->repository->getAllCategories();
        $tags = $this->repository->getAllTags();
        $config = [
            'route' => '/wikis/show',
            'action' => '/wikis/store',
            'method' => 'POST',
            'fields' => [
                [
                    'name' => 'author_id',
                    'type' => 'hidden',
                    'label' => 'auteur',
                    'value' => $_SESSION['user_id']
                ],
                [
                    'name' => 'image',
                    'type' => 'file',
                    'label' => 'image'
                ],
                [
                    'name' => 'title',
                    'type' => 'text',
                    'label' => 'titre'
                ],
                [
                    'name' => 'description',
                    'type' => 'textarea',
                    'label' => 'description'
                ],
                [
                    'name' => 'content',
                    'type' => 'textarea',
                    'label' => 'contenu'
                ],
                [
                    'name' => 'category_id',
                    'type' => 'select',
                    'label' => 'catégorie',
                    'options' => $categories
                ],
                [
                    'name' => 'tags',
                    'type' => 'checkbox',
                    'label' => 'tags',
                    'options' => $tags
                ],
                [
                    'name' => 'is_archived',
                    'type' => 'hidden',
                    'label' => 'is_archived',
                    'value' => 0
                ]
            ]
        ];
        $this->render('backOffice/wikis/create', compact('config'));
    }

    public function delete(): void
    {
        $this->repository->delete($_POST['id']);
        header('Location: /wikis/show');
    }

    public function update(): void
    {
        $wiki = $this->repository->find($_POST['id']);
        $categories = $this->repository->getAllCategories();
        $allTags = $this->repository->getAllTags();
        $tags = $this->repository->getTags($wiki->id);
        $category = $this->repository->getCategory($wiki->id);
        $config = [
            'route' => '/wikis/show',
            'action' => '/wikis/edit',
            'method' => 'POST',
            'fields' => [
                [
                    'name' => 'id',
                    'type' => 'hidden',
                    'label' => 'id',
                    'value' => $wiki->id
                ],
                [
                    'name' => 'image',
                    'type' => 'file',
                    'label' => 'image'
                ],
                [
                    'name' => 'title',
                    'type' => 'text',
                    'label' => 'titre'
                ],
                [
                    'name' => 'description',
                    'type' => 'textarea',
                    'label' => 'description'
                ],
                [
                    'name' => 'content',
                    'type' => 'textarea',
                    'label' => 'contenu'
                ],
                [
                    'name' => 'category_id',
                    'type' => 'select',
                    'label' => 'catégorie',
                    'options' => $categories
                ],
                [
                    'name' => 'tags',
                    'type' => 'checkbox',
                    'label' => 'tags',
                    'options' => $allTags
                ]
            ]
        ];
        $data = [
            'id' => $wiki->id,
            'image' => $wiki->image,
            'title' => $wiki->title,
            'description' => $wiki->description,
            'content' => $wiki->content,
            'category_id' => $category,
            'tags' => $tags
        ];
        $this->render('backOffice/wikis/update', compact('config', 'data'));
    }

    public function edit(): void
    {
        $id = $_POST['id'];
        if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $imageContent = file_get_contents($_FILES['image']['tmp_name']);
            $data = [
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'content' => $_POST['content'],
                'category_id' => $_POST['category_id'],
                'image' => $imageContent
            ];
        } else {
            $data = [
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'content' => $_POST['content'],
                'category_id' => $_POST['category_id']
            ];
        }
        $this->repository->update($id, $data);
        $this->repository->updateWikiTags($id, $_POST['tags']);
        header('Location: /wikis/show');
    }
}