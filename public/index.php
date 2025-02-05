<!--  -->

<?php

require_once __DIR__ . '/../vendor/autoload.php';

session_start();

use App\Core\Router;

$router = new Router();

$router->addRoute('GET', '/', 'AuthController@login');
$router->addRoute('GET', '/login', 'AuthController@login');
$router->addRoute('POST', '/login', 'AuthController@login');
$router->addRoute('GET', '/register', 'AuthController@register');
$router->addRoute('POST', '/register', 'AuthController@register');
$router->addRoute('GET', '/logout', 'AuthController@logout');

$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);