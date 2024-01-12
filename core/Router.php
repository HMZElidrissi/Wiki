<?php

namespace Core;

use Core\Middleware\Middleware;

class Router
{
    public $routes = [];

    public function add($method, $uri, $controller, $action, $middleware = null)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'action' => $action,
            'method' => $method,
            'middleware' => $middleware
        ];
    }

    public function get($uri, $controller, $action, $middleware = null)
    {
        $this->add('GET', $uri, $controller, $action, $middleware);
    }

    public function post($uri, $controller, $action, $middleware = null)
    {
        $this->add('POST', $uri, $controller, $action, $middleware);
    }

    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                if ($route['middleware']) {
                    Middleware::getMiddlewareByKey($route['middleware']);
                }
                return $route;
            }
        }
        throw new \Exception("No route found for {$uri}.");
    }
}
