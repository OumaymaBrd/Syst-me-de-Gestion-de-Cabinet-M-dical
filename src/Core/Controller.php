<?php

namespace App\Core;

abstract class Controller
{
    protected function render($view, $data = [])
    {
        extract($data);
        include __DIR__ . "/../Views/templates/header.php";
        include __DIR__ . "/../Views/$view.php";
        include __DIR__ . "/../Views/templates/footer.php";
    }

    protected function redirect($url)
    {
        header("Location: $url");
        exit;
    }

    protected function isLoggedIn()
    {
        return isset($_SESSION['user_id']);
    }

    protected function requireLogin()
    {
        if (!$this->isLoggedIn()) {
            $this->redirect('/login');
        }
    }

    protected function requireAdmin()
    {
        $this->requireLogin();
        if ($_SESSION['user_role'] !== 'admin') {
            $this->redirect('/');
        }
    }
}