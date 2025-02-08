<?php

require_once 'User.php';

class Medecin extends User {
    public function __construct($id = null) {
        parent::__construct($id);
    }

    public function getAppointments() {
        $stmt = $this->db->prepare("SELECT r.*, u.nom as patient_nom FROM rendez_vous r JOIN users u ON r.patient_id = u.id WHERE r.medecin_id = ? ORDER BY r.date DESC");
        $stmt->execute([$this->id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateAppointmentStatus($appointment_id, $statut) {
        $stmt = $this->db->prepare("UPDATE rendez_vous SET statut = ? WHERE id = ? AND medecin_id = ?");
        return $stmt->execute([$statut, $appointment_id, $this->id]);
    }

    public function getConsultations() {
        $stmt = $this->db->prepare("SELECT r.*, u.nom as patient_nom FROM rendez_vous r JOIN users u ON r.patient_id = u.id WHERE r.medecin_id = ? AND r.type = 'consultation' ORDER BY r.date DESC");
        $stmt->execute([$this->id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function replyToConsultation($consultation_id, $reponse) {
        $stmt = $this->db->prepare("UPDATE rendez_vous SET consultation_reponse = CONCAT(IFNULL(consultation_reponse, ''), '\n\nMédecin: ', ?), consultation_statut = 'repondu' WHERE id = ? AND medecin_id = ?");
        return $stmt->execute([$reponse, $consultation_id, $this->id]);
    }

    public function countAppointments() {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM rendez_vous WHERE medecin_id = ? AND type = 'rendez_vous'");
        $stmt->execute([$this->id]);
        return $stmt->fetchColumn();
    }

    public function countConsultations() {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM rendez_vous WHERE medecin_id = ? AND type = 'consultation'");
        $stmt->execute([$this->id]);
        return $stmt->fetchColumn();
    }

    public function getConsultationById($id) {
        $stmt = $this->db->prepare("SELECT r.*, p.nom as patient_nom, m.nom as medecin_nom 
                                    FROM rendez_vous r 
                                    JOIN users p ON r.patient_id = p.id 
                                    JOIN users m ON r.medecin_id = m.id 
                                    WHERE r.id = ? AND r.medecin_id = ? AND r.type = 'consultation'");
        $stmt->execute([$id, $this->id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAppointmentById($id) {
        $stmt = $this->db->prepare("SELECT r.*, p.nom as patient_nom, m.nom as medecin_nom 
                                    FROM rendez_vous r 
                                    JOIN users p ON r.patient_id = p.id 
                                    JOIN users m ON r.medecin_id = m.id 
                                    WHERE r.id = ? AND r.medecin_id = ? AND r.type = 'rendez_vous'");
        $stmt->execute([$id, $this->id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getAllMedecins() {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->query("SELECT id, nom FROM users WHERE role = 'medecin'");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

