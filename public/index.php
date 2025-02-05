<?php

require_once __DIR__ . '/../vendor/autoload.php';

session_start();

use App\Core\Router;

$router = new Router();

// Charger les routes
require_once __DIR__ . '/../config/routes.php';

// Dispatcher la requête
try {
    $router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
} catch (Exception $e) {
    // Gérer les erreurs
    echo 'Une erreur est survenue : ' . $e->getMessage();
}