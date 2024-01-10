<?php

use Core\Router;
use App\Controllers\HomeController;
use App\Controllers\Admin\WikiController;
use App\Controllers\Author\WikiController as AuthorWikiController;

$router = new Router();

// TODO: Add middleware to check if user is logged in

$router->get('/', HomeController::class, 'index');
$router->get('/dashboard', HomeController::class, 'dashboard');
$router->get('/login', HomeController::class, 'login');
$router->get('/register', HomeController::class, 'register');
$router->get('/wikis/show', WikiController::class, 'show');
$router->get('/wikis/show', AuthorWikiController::class, 'show');



return $router;