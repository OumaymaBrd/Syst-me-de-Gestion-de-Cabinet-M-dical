<?php

namespace App\Core;

abstract class Controller
{
    protected function render($view, $data = [])
    {
        extract($data);
        
        ob_start();
        require_once dirname(__DIR__) . "/app/Views/{$view}.php";
        $content = ob_get_clean();
        
        require_once dirname(__DIR__) . "/app/Views/layouts/main.php";
    }

    protected function redirect($url)
    {
        header("Location: $url");
        exit;
    }

    protected function json($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}