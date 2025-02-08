<?php

require_once ROOT_PATH . 'models/User.php';
require_once ROOT_PATH . 'models/Appointment.php';

class AdminController {
    private $userModel;
    private $appointmentModel;

    public function __construct() {
        $this->userModel = new User();
        $this->appointmentModel = new Appointment();
    }

    public function dashboard() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header('Location: ' . BASE_URL . '?action=login');
            exit;
        }

        $users = $this->userModel->getAllUsers();
        $appointments = $this->appointmentModel->getAllAppointments();

        $total_patients = count(array_filter($users, function($user) { return $user['role'] === 'patient'; }));
        $total_consultations = count(array_filter($appointments, function($app) { return $app['type'] === 'consultation'; }));
        $total_rendez_vous = count(array_filter($appointments, function($app) { return $app['type'] === 'rendez_vous' && $app['statut'] === 'termine'; }));

        require ROOT_PATH . 'views/admin/dashboard.php';
    }
}

