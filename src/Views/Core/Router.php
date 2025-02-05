<?php

namespace App\Core;

class Router
{
    private $routes = [];

    public function addRoute($method, $path, $handler)
    {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'handler' => $handler
        ];
    }

    public function dispatch($method, $uri)
    {
        $uri = strtok($uri, '?');
        foreach ($this->routes as $route) {
            if ($route['method'] === $method && $this->matchPath($route['path'], $uri, $params)) {
                list($controller, $action) = explode('@', $route['handler']);
                $controllerClass = "App\\Controllers\\$controller";
                $controllerInstance = new $controllerClass();
                call_user_func_array([$controllerInstance, $action], $params);
                return;
            }
        }

        // If no route matches, show 404 error
        header("HTTP/1.0 404 Not Found");
        echo "404 Not Found";
    }

    private function matchPath($routePath, $uri, &$params)
    {
        $routeParts = explode('/', trim($routePath, '/'));
        $uriParts = explode('/', trim($uri, '/'));

        if (count($routeParts) !== count($uriParts)) {
            return false;
        }

        $params = [];

        for ($i = 0; $i < count($routeParts); $i++) {
            if (strpos($routeParts[$i], ':') === 0) {
                $params[] = $uriParts[$i];
            } elseif ($routeParts[$i] !== $uriParts[$i]) {
                return false;
            }
        }

        return true;
    }
}