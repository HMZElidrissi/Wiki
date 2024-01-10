<?php

use Core\Router;
use App\Controllers\HomeController;

$router = new Router();

$router->get('/', HomeController::class, 'home');
$router->get('/dashboard', HomeController::class, 'dashboard');
$router->get('/login', HomeController::class, 'login');
$router->get('/register', HomeController::class, 'register');



return $router;