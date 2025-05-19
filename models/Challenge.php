<?php
class Challenge {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=hackathon', 'root', '');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getAllChallenges() {
        $query = "SELECT * FROM challenges ORDER BY date_debut DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getChallenge($id) {
        $query = "SELECT * FROM challenges WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createChallenge($nom, $description, $date_debut, $date_fin) {
        $query = "INSERT INTO challenges (nom, description, date_debut, date_fin) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$nom, $description, $date_debut, $date_fin]);
    }

    public function updateChallenge($id, $nom, $description, $statut, $date_debut, $date_fin) {
        $query = "UPDATE challenges SET nom = ?, description = ?, statut = ?, date_debut = ?, date_fin = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$nom, $description, $statut, $date_debut, $date_fin, $id]);
    }

    public function deleteChallenge($id) {
        $query = "DELETE FROM challenges WHERE id = ?";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$id]);
    }

    public function inscrireParticipant($challenge_id, $apprenant_id) {
        $query = "INSERT INTO challenge_participants (challenge_id, apprenant_id) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$challenge_id, $apprenant_id]);
    }

    public function getParticipants($challenge_id) {
        $query = "SELECT a.* FROM apprenants a 
                  JOIN challenge_participants cp ON a.id = cp.apprenant_id 
                  WHERE cp.challenge_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$challenge_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}