<?php

namespace App\Core;

abstract class Controller
{
    protected $view;
    protected $security;

    public function __construct()
    {
        $this->view = new View();
        $this->security = new Security();
    }

    protected function render($template, $data = [])
    {
        return $this->view->render($template, $data);
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

    protected function requireRole($role)
    {
        $this->requireLogin();
        if ($_SESSION['user_role'] !== $role) {
            $this->redirect('/');
        }
    }
}