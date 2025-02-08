<?php

require_once 'User.php';

class Patient extends User {
    public function __construct($id = null) {
        parent::__construct($id);
    }

    public function getAppointments() {
        $stmt = $this->db->prepare("SELECT r.*, u.nom as medecin_nom FROM rendez_vous r JOIN users u ON r.medecin_id = u.id WHERE r.patient_id = ? ORDER BY r.date DESC");
        $stmt->execute([$this->id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createAppointment($medecin_id, $date, $description, $type) {
        $stmt = $this->db->prepare("INSERT INTO rendez_vous (patient_id, medecin_id, date, description, statut, type) VALUES (?, ?, ?, ?, 'en_attente', ?)");
        return $stmt->execute([$this->id, $medecin_id, $date, $description, $type]);
    }

    public function updateAppointment($appointment_id, $date) {
        $stmt = $this->db->prepare("UPDATE rendez_vous SET date = ? WHERE id = ? AND patient_id = ?");
        return $stmt->execute([$date, $appointment_id, $this->id]);
    }

    public function deleteAppointment($appointment_id) {
        $stmt = $this->db->prepare("DELETE FROM rendez_vous WHERE id = ? AND patient_id = ?");
        return $stmt->execute([$appointment_id, $this->id]);
    }

    public function getConsultations() {
        $stmt = $this->db->prepare("SELECT r.*, u.nom as medecin_nom FROM rendez_vous r JOIN users u ON r.medecin_id = u.id WHERE r.patient_id = ? AND r.type = 'consultation' ORDER BY r.date DESC");
        $stmt->execute([$this->id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createConsultation($medecin_id, $description) {
        $stmt = $this->db->prepare("INSERT INTO rendez_vous (patient_id, medecin_id, date, description, statut, type, consultation_description, consultation_statut) VALUES (?, ?, NOW(), ?, 'en_attente', 'consultation', ?, 'en_attente')");
        return $stmt->execute([$this->id, $medecin_id, $description, $description]);
    }

    public function replyToConsultation($consultation_id, $reponse) {
        $stmt = $this->db->prepare("UPDATE rendez_vous SET consultation_description = CONCAT(consultation_description, '\n\nPatient: ', ?), consultation_statut = 'en_cours' WHERE id = ? AND patient_id = ?");
        return $stmt->execute([$reponse, $consultation_id, $this->id]);
    }

    public function getAppointmentById($id) {
        $stmt = $this->db->prepare("SELECT r.*, m.nom as medecin_nom 
                                    FROM rendez_vous r 
                                    JOIN users m ON r.medecin_id = m.id 
                                    WHERE r.id = ? AND r.patient_id = ?");
        $stmt->execute([$id, $this->id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getConsultationById($id) {
        $stmt = $this->db->prepare("SELECT r.*, m.nom as medecin_nom 
                                    FROM rendez_vous r 
                                    JOIN users m ON r.medecin_id = m.id 
                                    WHERE r.id = ? AND r.patient_id = ? AND r.type = 'consultation'");
        $stmt->execute([$id, $this->id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

