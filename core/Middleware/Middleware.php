<?php

namespace Core\Middleware;

class Middleware
{
    public const MAP = [
        'guest' => Guest::class,
        'admin' => Admin::class,
        'author' => Author::class
    ];

    public static function getMiddlewareByKey($key): void
    {
        $middleware = static::MAP[$key] ?? false;

        if (!$middleware) {
            throw new \Exception("No matching middleware found for '{$key}'.");
        }

        (new $middleware)->handle();
    }
}