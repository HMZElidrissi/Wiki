<?php

use Core\Router;
use App\Controllers\HomeController;
use App\Controllers\AuthController;
use App\Controllers\Admin\WikiController;
use App\Controllers\Admin\TagController;
use App\Controllers\Admin\CategoryController;
use App\Controllers\Author\WikiController as AuthorWikiController;

$router = new Router();

// Public routes
$router->get('/', HomeController::class, 'index');
$router->get('/wiki', HomeController::class, 'show');
$router->get('/dashboard', HomeController::class, 'dashboard');
$router->post('/search', HomeController::class, 'search');
$router->get('/login', HomeController::class, 'login', 'guest');
$router->post('/login', AuthController::class, 'login', 'guest');
$router->get('/register', HomeController::class, 'register', 'guest');
$router->post('/register', AuthController::class, 'register', 'guest');
$router->post('/logout', AuthController::class, 'logout');
$router->get('/{code}', HomeController::class, 'error');

// Admin routes for managing tags
$router->get('/tags', TagController::class, 'show', 'admin');
$router->get('/tags/create', TagController::class, 'create', 'admin');
$router->post('/tags/store', TagController::class, 'store', 'admin');
$router->post('/tags/delete', TagController::class, 'delete', 'admin');
$router->post('/tags/update', TagController::class, 'update', 'admin');
$router->post('/tags/edit', TagController::class, 'edit', 'admin');

// Admin routes for managing categories
$router->get('/categories', CategoryController::class, 'show', 'admin');
$router->get('/categories/create', CategoryController::class, 'create', 'admin');
$router->post('/categories/store', CategoryController::class, 'store', 'admin');
$router->post('/categories/delete', CategoryController::class, 'delete', 'admin');
$router->post('/categories/update', CategoryController::class, 'update', 'admin');
$router->post('/categories/edit', CategoryController::class, 'edit', 'admin');

// Admin routes for managing wikis
$router->get('/wikis/display', WikiController::class, 'display', 'admin');
$router->post('/wikis/archive', WikiController::class, 'archive', 'admin');
$router->post('/wikis/restore', WikiController::class, 'restore', 'admin');
$router->get('/wikis/archived', WikiController::class, 'archived', 'admin');

// Author routes for managing wikis
$router->get('/wikis', AuthorWikiController::class, 'show');
$router->get('/wikis/create', AuthorWikiController::class, 'create', 'author');
$router->post('/wikis/store', AuthorWikiController::class, 'store', 'author');
$router->post('/wikis/delete', AuthorWikiController::class, 'delete', 'author');
$router->post('/wikis/update', AuthorWikiController::class, 'update', 'author');
$router->post('/wikis/edit', AuthorWikiController::class, 'edit', 'author');


return $router;