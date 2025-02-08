<?php

require_once ROOT_PATH . 'models/Patient.php';
require_once ROOT_PATH . 'models/Medecin.php';

class ConsultationController {
    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '?action=login');
            exit;
        }

        $user_id = $_SESSION['user_id'];
        $role = $_SESSION['role'];

        if ($role === 'patient') {
            $patient = new Patient($user_id);
            $consultations = $patient->getConsultations();
        } elseif ($role === 'medecin') {
            $medecin = new Medecin($user_id);
            $consultations = $medecin->getConsultations();
        } else {
            header('Location: ' . BASE_URL);
            exit;
        }

        require ROOT_PATH . 'views/consultations/list.php';
    }

    public function create() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'patient') {
            header('Location: ' . BASE_URL . '?action=login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $patient = new Patient($_SESSION['user_id']);
            $medecin_id = $_POST['medecin_id'];
            $description = $_POST['description'];

            if ($patient->createConsultation($medecin_id, $description)) {
                $_SESSION['success'] = "Demande de consultation envoyée avec succès";
                header('Location: ' . BASE_URL . '?action=consultations');
                exit;
            } else {
                $_SESSION['error'] = "Erreur lors de la création de la consultation";
            }
        }

        $medecins = Medecin::getAllMedecins();
        require ROOT_PATH . 'views/consultations/form.php';
    }

    public function reply() {
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['success' => false, 'message' => 'Non autorisé']);
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['rdv_id'];
            $reponse = $_POST['reponse'];

            if ($_SESSION['role'] === 'medecin') {
                $medecin = new Medecin($_SESSION['user_id']);
                $success = $medecin->replyToConsultation($id, $reponse);
            } elseif ($_SESSION['role'] === 'patient') {
                $patient = new Patient($_SESSION['user_id']);
                $success = $patient->replyToConsultation($id, $reponse);
            } else {
                echo json_encode(['success' => false, 'message' => 'Rôle non autorisé']);
                exit;
            }

            if ($success) {
                echo json_encode(['success' => true, 'message' => 'Réponse envoyée avec succès']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'envoi de la réponse']);
            }
            exit;
        }
    }

    public function view() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '?action=login');
            exit;
        }

        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: ' . BASE_URL . '?action=consultations');
            exit;
        }

        if ($_SESSION['role'] === 'patient') {
            $patient = new Patient($_SESSION['user_id']);
            $consultation = $patient->getConsultationById($id);
        } elseif ($_SESSION['role'] === 'medecin') {
            $medecin = new Medecin($_SESSION['user_id']);
            $consultation = $medecin->getConsultationById($id);
        }

        if (!$consultation) {
            $_SESSION['error'] = "Consultation non trouvée";
            header('Location: ' . BASE_URL . '?action=consultations');
            exit;
        }

        require ROOT_PATH . 'views/consultations/view.php';
    }
}

