<?php

namespace Core;

class Router
{
    protected $routes = [];

    public function get($uri, $controller)
    {
        $uri = trim($uri, '/');
        $this->routes['GET'][$uri] = $controller;
    }

    public function post($uri, $controller)
    {
        $uri = trim($uri, '/');
        $this->routes['POST'][$uri] = $controller;
    }

    public function handleRequest($uri)
    {
        $method = $_SERVER['REQUEST_METHOD'];

        $uri = trim(parse_url($uri, PHP_URL_PATH), '/');
        if (isset($this->routes[$method][$uri])) {
            list($controller, $method) = explode('@', $this->routes[$method][$uri]);
            $this->callController($controller, $method);
        } else {
            echo "404 Not Found";
        }
    }

    protected function callController($controller, $method)
    {
        if (class_exists($controller) && method_exists($controller, $method)) {
            $controllerInstance = new $controller();
            $controllerInstance->$method();
        } else {
            echo "404 Not Found";
        }
    }
}
