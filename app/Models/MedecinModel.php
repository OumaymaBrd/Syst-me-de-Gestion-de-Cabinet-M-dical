<?php

namespace App\Models;

class MedecinModel extends UserModel
{
    public function getSchedule($medecinId)
    {
        $sql = "SELECT * FROM appointments WHERE medecin_id = :medecin_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['medecin_id' => $medecinId]);
        return $stmt->fetchAll();
    }

    public function updateAvailability($medecinId, $availability)
    {
        $sql = "UPDATE {$this->table} SET availability = :availability WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['availability' => $availability, 'id' => $medecinId]);
    }
}