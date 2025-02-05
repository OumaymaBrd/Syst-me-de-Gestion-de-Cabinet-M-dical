<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\UserModel;

class AuthController extends Controller
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function login()
    {
        if ($this->isLoggedIn()) {
            $this->redirectToDashboard();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->userModel->findByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_role'] = $user['role'];
                $this->redirectToDashboard();
            } else {
                $error = "Email ou mot de passe invalide";
                $this->render('auth/login', ['error' => $error]);
            }
        } else {
            $this->render('auth/login');
        }
    }

    public function register()
    {
        if ($this->isLoggedIn()) {
            $this->redirectToDashboard();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];
            $role = $_POST['role'];

            if (empty($name) || empty($email) || empty($password) || empty($confirmPassword) || empty($role)) {
                $error = "Tous les champs sont requis";
                $this->render('auth/register', ['error' => $error]);
                return;
            }

            if ($password !== $confirmPassword) {
                $error = "Les mots de passe ne correspondent pas";
                $this->render('auth/register', ['error' => $error]);
                return;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "Email invalide";
                $this->render('auth/register', ['error' => $error]);
                return;
            }

            if ($this->userModel->findByEmail($email)) {
                $error = "Cet email est déjà utilisé";
                $this->render('auth/register', ['error' => $error]);
                return;
            }

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $userId = $this->userModel->create([
                'name' => $name,
                'email' => $email,
                'password' => $hashedPassword,
                'role' => $role
            ]);

            if ($userId) {
                $_SESSION['user_id'] = $userId;
                $_SESSION['user_role'] = $role;
                $this->redirectToDashboard();
            } else {
                $error = "Une erreur est survenue lors de l'inscription";
                $this->render('auth/register', ['error' => $error]);
            }
        } else {
            $this->render('auth/register');
        }
    }

    public function logout()
    {
        session_destroy();
        $this->redirect('/login');
    }

    private function redirectToDashboard()
    {
        switch ($_SESSION['user_role']) {
            case 'admin':
                $this->redirect('/admin/dashboard');
                break;
            case 'patient':
                $this->redirect('/patient/profile');
                break;
            case 'medecin':
                $this->redirect('/medecin/profile');
                break;
            default:
                $this->redirect('/');
                break;
        }
    }
}