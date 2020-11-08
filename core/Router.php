<?php

/*
 * TODO
 * Change route register methods to receive a controller method instead of a string
 * Middleware support
 */

namespace Core;

class Router
{
    private static array $routes = [
        'GET' => [],
        'POST' => [],
    ];

    public static function init($routesFile)
    {
        require $routesFile;
        return new self;
    }

    public static function get(string $uri, string $controller)
    {
        self::$routes['GET'][$uri] = $controller;
    }

    public static function post(string $uri, string $controller)
    {
        self::$routes['POST'][$uri] = $controller;
    }

    public static function direct(Request $request)
    {
        if (!array_key_exists($request->uri, self::$routes[$request->method])) {
            http_response_code(404);
            throw new \Exception("Route {$request->uri} is not defined for {$request->method} request.");
        }

        return self::callAction(
            $request,
            ...explode('@', self::$routes[$request->method][$request->uri])
        );
    }

    private static function callAction(Request $request, $controller, $action)
    {
        $controller = "App\\Controllers\\{$controller}";
        $controller = new $controller;

        if (!method_exists($controller, $action)) {
            http_response_code(404);
            throw new \Exception("{$controller} does not respond to the {$action} action.");
        }

        return $controller->$action($request);
    }
}