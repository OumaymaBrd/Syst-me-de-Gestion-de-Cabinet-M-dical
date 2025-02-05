<?php

return [
    'db' => [
        'host' => $_ENV['DB_HOST'],
        'name' => $_ENV['DB_NAME'],
        'user' => $_ENV['DB_USER'],
        'pass' => $_ENV['DB_PASS'],
        'charset' => $_ENV['DB_CHARSET']
    ],
    'app' => [
        'name' => 'Cabinet Médical',
        'url' => $_ENV['APP_URL'],
        'debug' => $_ENV['APP_DEBUG'] === 'true'
    ]
];