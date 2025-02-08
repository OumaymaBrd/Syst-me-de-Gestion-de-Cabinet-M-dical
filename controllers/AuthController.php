<?php

require_once ROOT_PATH . 'models/User.php';
require_once ROOT_PATH . 'models/Patient.php';
require_once ROOT_PATH . 'models/Medecin.php';

class AuthController {
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $role = $_POST['role'];

            $user = new User();
            if ($user->create($nom, $email, $password, $role)) {
                $_SESSION['success'] = "Inscription réussie. Vous pouvez maintenant vous connecter.";
                header('Location: ' . BASE_URL . '?action=login');
                exit;
            } else {
                $_SESSION['error'] = "Erreur lors de l'inscription.";
            }
        }

        require ROOT_PATH . 'views/auth/register.php';
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = User::findByEmail($email);

            if ($user && password_verify($password, $user->getPassword())) {
                $_SESSION['user_id'] = $user->getId();
                $_SESSION['role'] = $user->getRole();
                header('Location: ' . BASE_URL);
                exit;
            } else {
                $_SESSION['error'] = "Email ou mot de passe incorrect";
            }
        }

        require ROOT_PATH . 'views/auth/login.php';
    }

    public function logout() {
        session_destroy();
        header('Location: ' . BASE_URL);
        exit;
    }
}

