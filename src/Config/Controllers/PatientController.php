<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\PatientModel;

class PatientController extends Controller
{
    private $patientModel;

    public function __construct()
    {
        $this->patientModel = new PatientModel();
    }

    public function profile()
    {
        $patientId = $_SESSION['user_id'];
        $patient = $this->patientModel->findById($patientId);
        $this->render('patient/profile', ['patient' => $patient]);
    }

    public function appointments()
    {
        $patientId = $_SESSION['user_id'];
        $appointments = $this->patientModel->getAppointments($patientId);
        $this->render('patient/appointments', ['appointments' => $appointments]);
    }

    public function bookAppointment()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $patientId = $_SESSION['user_id'];
            $medecinId = $_POST['medecin_id'];
            $dateTime = $_POST['date_time'];

            if ($this->patientModel->bookAppointment([
                'patient_id' => $patientId,
                'medecin_id' => $medecinId,
                'date_time' => $dateTime
            ])) {
                $this->redirect('/patient/appointments');
            } else {
                // Handle error
            }
        } else {
            // Show booking form
            $this->render('patient/book_appointment');
        }
    }
}