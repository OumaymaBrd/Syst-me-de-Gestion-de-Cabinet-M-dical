<?php

namespace App\Models;

class PatientModel extends UserModel
{
    public function getAppointments($patientId)
    {
        $sql = "SELECT * FROM appointments WHERE patient_id = :patient_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['patient_id' => $patientId]);
        return $stmt->fetchAll();
    }

    public function bookAppointment($data)
    {
        $sql = "INSERT INTO appointments (patient_id, medecin_id, date_time) VALUES (:patient_id, :medecin_id, :date_time)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }
}