<?php
session_start();

define('ROOT_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR);
require_once ROOT_PATH . 'config/database.php';
require_once ROOT_PATH . 'config/config.php';
require_once ROOT_PATH . 'controllers/AuthController.php';
require_once ROOT_PATH . 'controllers/AppointmentController.php';
require_once ROOT_PATH . 'controllers/ConsultationController.php';
require_once ROOT_PATH . 'controllers/AdminController.php';

$action = $_GET['action'] ?? 'home';

$authController = new AuthController();
$appointmentController = new AppointmentController();
$consultationController = new ConsultationController();
$adminController = new AdminController();

switch ($action) {
    case 'register':
        $authController->register();
        break;
    case 'login':
        $authController->login();
        break;
    case 'logout':
        $authController->logout();
        break;
    case 'appointments':
        $appointmentController->index();
        break;
    case 'create_appointment':
        $appointmentController->create();
        break;
    case 'update_appointment':
        $appointmentController->update();
        break;
    case 'delete_appointment':
        $appointmentController->delete();
        break;
    case 'view_appointment':
        $appointmentController->view();
        break;
    case 'statistics':
        $appointmentController->statistics();
        break;
    case 'consultations':
        $consultationController->index();
        break;
    case 'create_consultation':
        $consultationController->create();
        break;
    case 'reply_consultation':
        $consultationController->reply();
        break;
    case 'view_consultation':
        $consultationController->view();
        break;
    case 'admin_dashboard':
        $adminController->dashboard();
        break;
    default:
        require ROOT_PATH . 'views/home.php';
        break;
}

