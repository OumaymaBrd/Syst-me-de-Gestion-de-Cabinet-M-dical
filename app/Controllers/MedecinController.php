<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\MedecinModel;

class MedecinController extends Controller
{
    private $medecinModel;

    public function __construct()
    {
        $this->medecinModel = new MedecinModel();
    }

    public function profile()
    {
        $medecinId = $_SESSION['user_id'];
        $medecin = $this->medecinModel->findById($medecinId);
        $this->render('medecin/profile', ['medecin' => $medecin]);
    }

    public function schedule()
    {
        $medecinId = $_SESSION['user_id'];
        $schedule = $this->medecinModel->getSchedule($medecinId);
        $this->render('medecin/schedule', ['schedule' => $schedule]);
    }

    public function updateAvailability()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $medecinId = $_SESSION['user_id'];
            $availability = $_POST['availability'];

            if ($this->medecinModel->updateAvailability($medecinId, $availability)) {
                $this->redirect('/medecin/profile');
            } else {
                // Handle error
            }
        } else {
            // Show update availability form
            $this->render('medecin/update_availability');
        }
    }
}