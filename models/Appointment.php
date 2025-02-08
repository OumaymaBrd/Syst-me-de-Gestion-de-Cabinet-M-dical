<?php

class Appointment {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function create($patient_id, $medecin_id, $date, $description, $type) {
        $stmt = $this->db->prepare("INSERT INTO rendez_vous (patient_id, medecin_id, date, description, statut, type) VALUES (?, ?, ?, ?, 'en_attente', ?)");
        return $stmt->execute([$patient_id, $medecin_id, $date, $description, $type]);
    }

    public function getAppointmentsByPatient($patient_id) {
        $stmt = $this->db->prepare("SELECT r.*, u.nom as medecin_nom FROM rendez_vous r JOIN users u ON r.medecin_id = u.id WHERE r.patient_id = ? ORDER BY r.date DESC");
        $stmt->execute([$patient_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAppointmentsByDoctor($medecin_id) {
        $stmt = $this->db->prepare("SELECT r.*, u.nom as patient_nom FROM rendez_vous r JOIN users u ON r.patient_id = u.id WHERE r.medecin_id = ? ORDER BY r.date DESC");
        $stmt->execute([$medecin_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateAppointment($id, $date, $statut = null) {
        if ($statut !== null) {
            $stmt = $this->db->prepare("UPDATE rendez_vous SET date = ?, statut = ? WHERE id = ?");
            return $stmt->execute([$date, $statut, $id]);
        } else {
            $stmt = $this->db->prepare("UPDATE rendez_vous SET date = ? WHERE id = ?");
            return $stmt->execute([$date, $id]);
        }
    }

    public function deleteAppointment($id, $patient_id) {
        $stmt = $this->db->prepare("DELETE FROM rendez_vous WHERE id = ? AND patient_id = ?");
        return $stmt->execute([$id, $patient_id]);
    }

    public function getAllAppointments() {
        $stmt = $this->db->query("SELECT r.*, p.nom as patient_nom, m.nom as medecin_nom FROM rendez_vous r JOIN users p ON r.patient_id = p.id JOIN users m ON r.medecin_id = m.id ORDER BY r.date DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAppointmentById($id) {
        $stmt = $this->db->prepare("SELECT r.*, p.nom as patient_nom, m.nom as medecin_nom FROM rendez_vous r JOIN users p ON r.patient_id = p.id JOIN users m ON r.medecin_id = m.id WHERE r.id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function countAppointmentsByDoctor($medecin_id) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM rendez_vous WHERE medecin_id = ? AND type = 'rendez_vous'");
        $stmt->execute([$medecin_id]);
        return $stmt->fetchColumn();
    }

    public function countConsultationsByDoctor($medecin_id) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM rendez_vous WHERE medecin_id = ? AND type = 'consultation'");
        $stmt->execute([$medecin_id]);
        return $stmt->fetchColumn();
    }
}

