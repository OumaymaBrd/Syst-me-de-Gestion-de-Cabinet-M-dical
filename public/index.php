<?php

require_once __DIR__ . '/../vendor/autoload.php';

// Charger les variables d'environnement
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

// Initialiser la session
session_start();

// Créer une instance du routeur
$router = new App\Core\Router();

// Charger les routes
require_once __DIR__ . '/../config/routes.php';
require_once __DIR__ . '/../vendor/autoload.php';

// Dispatcher la requête
$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);