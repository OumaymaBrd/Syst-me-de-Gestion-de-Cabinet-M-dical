<?php

require_once ROOT_PATH . 'models/Patient.php';
require_once ROOT_PATH . 'models/Medecin.php';

class AppointmentController {
    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '?action=login');
            exit;
        }

        $user_id = $_SESSION['user_id'];
        $role = $_SESSION['role'];

        if ($role === 'patient') {
            $patient = new Patient($user_id);
            $appointments = $patient->getAppointments();
        } elseif ($role === 'medecin') {
            $medecin = new Medecin($user_id);
            $appointments = $medecin->getAppointments();
        } else {
            header('Location: ' . BASE_URL);
            exit;
        }

        require ROOT_PATH . 'views/appointments/list.php';
    }

    public function create() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'patient') {
            header('Location: ' . BASE_URL . '?action=login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $patient = new Patient($_SESSION['user_id']);
            $medecin_id = $_POST['medecin_id'];
            $date = $_POST['date'];
            $description = $_POST['description'];
            $type = $_POST['type'];

            if ($patient->createAppointment($medecin_id, $date, $description, $type)) {
                $_SESSION['success'] = "Rendez-vous créé avec succès";
                header('Location: ' . BASE_URL . '?action=appointments');
                exit;
            } else {
                $_SESSION['error'] = "Erreur lors de la création du rendez-vous";
            }
        }

        $medecins = Medecin::getAllMedecins();
        require ROOT_PATH . 'views/appointments/form.php';
    }

    public function update() {
        header('Content-Type: application/json');
        
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'medecin') {
            echo json_encode(['success' => false, 'message' => 'Non autorisé']);
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false, 'message' => 'Méthode non autorisée']);
            exit;
        }

        $id = isset($_POST['rdv_id']) ? intval($_POST['rdv_id']) : null;
        $statut = isset($_POST['statut']) ? $_POST['statut'] : null;

        if (!$id || !$statut) {
            echo json_encode(['success' => false, 'message' => 'Données manquantes']);
            exit;
        }

        $medecin = new Medecin($_SESSION['user_id']);
        $success = $medecin->updateAppointmentStatus($id, $statut);

        if ($success) {
            echo json_encode([
                'success' => true,
                'message' => 'Statut du rendez-vous modifié avec succès'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Erreur lors de la modification du statut du rendez-vous'
            ]);
        }
        exit;
    }

    public function delete() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'patient') {
            header('Location: ' . BASE_URL . '?action=login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['rdv_id'];
            $patient = new Patient($_SESSION['user_id']);

            if ($patient->deleteAppointment($id)) {
                $_SESSION['success'] = "Rendez-vous annulé avec succès";
            } else {
                $_SESSION['error'] = "Erreur lors de l'annulation du rendez-vous";
            }
            header('Location: ' . BASE_URL . '?action=appointments');
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
            header('Location: ' . BASE_URL . '?action=appointments');
            exit;
        }

        if ($_SESSION['role'] === 'patient') {
            $patient = new Patient($_SESSION['user_id']);
            $appointment = $patient->getAppointmentById($id);
        } elseif ($_SESSION['role'] === 'medecin') {
            $medecin = new Medecin($_SESSION['user_id']);
            $appointment = $medecin->getAppointmentById($id);
        }

        if (!$appointment) {
            $_SESSION['error'] = "Rendez-vous non trouvé";
            header('Location: ' . BASE_URL . '?action=appointments');
            exit;
        }

        require ROOT_PATH . 'views/appointments/view.php';
    }

    public function statistics() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'medecin') {
            header('Location: ' . BASE_URL . '?action=login');
            exit;
        }

        $medecin = new Medecin($_SESSION['user_id']);
        $appointmentsCount = $medecin->countAppointments();
        $consultationsCount = $medecin->countConsultations();

        require ROOT_PATH . 'views/appointments/statistics.php';
    }
}

