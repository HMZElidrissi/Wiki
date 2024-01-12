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
$router->get('/dashboard', HomeController::class, 'dashboard');
$router->post('/search', HomeController::class, 'search');
$router->get('/login', HomeController::class, 'login');
$router->post('/login', AuthController::class, 'login');
$router->get('/register', HomeController::class, 'register');
$router->post('/register', AuthController::class, 'register');
$router->post('/logout', AuthController::class, 'logout');
$router->get('/{code}', HomeController::class, 'error');

// Admin routes for managing tags
$router->get('/tags', TagController::class, 'show');
$router->get('/tags/create', TagController::class, 'create');
$router->post('/tags/store', TagController::class, 'store');
$router->post('/tags/delete', TagController::class, 'delete');
$router->post('/tags/update', TagController::class, 'update');
$router->post('/tags/edit', TagController::class, 'edit');

// Admin routes for managing categories
$router->get('/categories', CategoryController::class, 'show');
$router->get('/categories/create', CategoryController::class, 'create');
$router->post('/categories/store', CategoryController::class, 'store');
$router->post('/categories/delete', CategoryController::class, 'delete');
$router->post('/categories/update', CategoryController::class, 'update');
$router->post('/categories/edit', CategoryController::class, 'edit');

// Admin routes for managing wikis
$router->get('/wikis/display', WikiController::class, 'display');
$router->post('/wikis/archive', WikiController::class, 'archive');
$router->post('/wikis/restore', WikiController::class, 'restore');
$router->get('/wikis/archived', WikiController::class, 'archived');

// Author routes for managing wikis
$router->get('/wikis', AuthorWikiController::class, 'show');
$router->get('/wikis/create', AuthorWikiController::class, 'create');
$router->post('/wikis/store', AuthorWikiController::class, 'store');
$router->post('/wikis/delete', AuthorWikiController::class, 'delete');
$router->post('/wikis/update', AuthorWikiController::class, 'update');
$router->post('/wikis/edit', AuthorWikiController::class, 'edit');


return $router;