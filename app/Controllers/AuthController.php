<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class AuthController extends Controller
{
    private $userModel;

    public function __construct()
    {
        parent::__construct();
        $this->userModel = new User();
    }

    public function login()
    {
        if ($this->isLoggedIn()) {
            $this->redirect('/dashboard');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->userModel->findByEmail($email);

            if ($user && $this->security->verifyPassword($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_role'] = $user['role'];
                $this->redirect('/dashboard');
            } else {
                return $this->render('auth/login', [
                    'error' => 'Email ou mot de passe incorrect'
                ]);
            }
        }

        return $this->render('auth/login');
    }

    public function register()
    {
        if ($this->isLoggedIn()) {
            $this->redirect('/dashboard');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'password' => $this->security->hashPassword($_POST['password']),
                'role' => $_POST['role']
            ];

            if ($this->userModel->create($data)) {
                $this->redirect('/login');
            } else {
                return $this->render('auth/register', [
                    'error' => 'Erreur lors de l\'inscription'
                ]);
            }
        }

        return $this->render('auth/register');
    }

    public function logout()
    {
        session_destroy();
        $this->redirect('/login');
    }
}