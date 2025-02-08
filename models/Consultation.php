<?php

class Consultation {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function create($patient_id, $medecin_id, $description) {
        $stmt = $this->db->prepare("INSERT INTO rendez_vous (patient_id, medecin_id, date, description, statut, type, consultation_description, consultation_statut) VALUES (?, ?, NOW(), ?, 'en_attente', 'consultation', ?, 'en_attente')");
        return $stmt->execute([$patient_id, $medecin_id, $description, $description]);
    }

    public function getConsultationsByPatient($patient_id) {
        $stmt = $this->db->prepare("SELECT r.*, u.nom as medecin_nom FROM rendez_vous r JOIN users u ON r.medecin_id = u.id WHERE r.patient_id = ? AND r.type = 'consultation' ORDER BY r.date DESC");
        $stmt->execute([$patient_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getConsultationsByDoctor($medecin_id) {
        $stmt = $this->db->prepare("SELECT r.*, u.nom as patient_nom FROM rendez_vous r JOIN users u ON r.patient_id = u.id WHERE r.medecin_id = ? AND r.type = 'consultation' ORDER BY r.date DESC");
        $stmt->execute([$medecin_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateConsultation($id, $reponse) {
        $stmt = $this->db->prepare("UPDATE rendez_vous SET consultation_reponse = CONCAT(IFNULL(consultation_reponse, ''), '\n\nMédecin: ', ?), consultation_statut = 'repondu' WHERE id = ?");
        return $stmt->execute([$reponse, $id]);
    }

    public function repondrePatient($id, $reponse) {
        $stmt = $this->db->prepare("UPDATE rendez_vous SET consultation_description = CONCAT(consultation_description, '\n\nPatient: ', ?), consultation_statut = 'en_cours' WHERE id = ?");
        return $stmt->execute([$reponse, $id]);
    }

    public function getConsultationById($id) {
        $stmt = $this->db->prepare("SELECT r.*, p.nom as patient_nom, m.nom as medecin_nom FROM rendez_vous r JOIN users p ON r.patient_id = p.id JOIN users m ON r.medecin_id = m.id WHERE r.id = ? AND r.type = 'consultation'");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

