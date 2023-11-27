<?php

namespace Server;

use Server\Utils\Information;

class Router
{
    public static array $routes = [
        ["/", "GET", Information::class, "index"]
    ];

    public static function route(string $route, string $method): array
    {
        $result = ["error" => "Not found :("];

        foreach (self::$routes as $key) {
            if ($key[0] == $route && $key[1] == $method) {
                $instance = new $key[2];
                $result = $instance->{$key[3]}();
                break;
            }
        }

        return $result;
    }
}