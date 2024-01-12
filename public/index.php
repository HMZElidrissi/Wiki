<?php
session_start();
$_SESSION['user_id'] = 1;
require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

$router = require_once 'routes.php';

function abort($code = 404)
{
    http_response_code($code);
    (new \App\Controllers\HomeController())->error($code);
}

function dd($data)
{
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
    die();
}


try {
    $route = $router->route($uri, $method);
} catch (Exception $e) {
    abort();
}

$controller = new $route['controller']();
$action = $route['action'];
$controller->$action();