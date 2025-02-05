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
        $uri = parse_url($uri, PHP_URL_PATH);
        
        foreach ($this->routes as $route) {
            if ($route['method'] === $method && $this->matchPath($route['path'], $uri, $params)) {
                [$controller, $action] = $route['handler'];
                $controllerInstance = new $controller();
                call_user_func_array([$controllerInstance, $action], $params);
                return;
            }
        }

        // Si aucune route ne correspond
        header("HTTP/1.0 404 Not Found");
        include __DIR__ . '/../app/Views/errors/404.php';
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