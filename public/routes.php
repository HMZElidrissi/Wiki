<?php

use Core\Router;
use App\Controllers\HomeController;
use App\Controllers\Admin\WikiController;
use App\Controllers\Author\WikiController as AuthorWikiController;

$router = new Router();

$router->get('/', HomeController::class, 'index');
$router->get('/dashboard', HomeController::class, 'dashboard');
$router->get('/login', HomeController::class, 'login');
$router->get('/register', HomeController::class, 'register');
$router->get('/wikis/display', WikiController::class, 'display');
$router->get('/wikis/show', AuthorWikiController::class, 'show');
$router->get('/wikis/create', AuthorWikiController::class, 'create');
$router->post('/wikis/store', AuthorWikiController::class, 'store');
$router->post('/wikis/delete', AuthorWikiController::class, 'delete');
$router->post('/wikis/update', AuthorWikiController::class, 'update');
$router->post('/wikis/edit', AuthorWikiController::class, 'edit');
$router->post('/wikis/archive', WikiController::class, 'archive');
$router->post('/wikis/restore', WikiController::class, 'restore');
$router->get('/wikis/archived', WikiController::class, 'archived');
$router->get('/{code}', HomeController::class, 'error');


return $router;