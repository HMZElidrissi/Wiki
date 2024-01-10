<?php

namespace Core;

use Core\Middleware\Middleware;

class Router
{
    public $routes = [];

    public function add($method, $uri, $controller, $action)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'action' => $action,
            'method' => $method,
            'middleware' => null
        ];
    }

    public function get($uri, $controller, $action)
    {
        $this->add('GET', $uri, $controller, $action);
    }

    public function post($uri, $controller, $action)
    {
        $this->add('POST', $uri, $controller, $action);
    }

    public function middleware($key)
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;
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
