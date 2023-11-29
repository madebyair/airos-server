<?php

namespace Server;

use Server\Methods\AuthMethod;
use Server\Utils\Information;

class Router
{
    public static array $routes = [
        ["/", "GET", Information::class, "index"],
        ["/login", "POST", AuthMethod::class, "login"]
    ];

    public static function route(string $route, string $method, $request): array
    {
        $result = ["error" => "Not found :("];

        foreach (self::$routes as $key) {
            if ($key[0] == $route && $key[1] == $method) {
                $instance = new $key[2];
                $result = $instance->{$key[3]}($request);
                break;
            }
        }

        return $result;
    }
}