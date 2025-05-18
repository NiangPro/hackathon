<?php
class Apprenant {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=hackathon;charset=utf8', 'root', '');
    }

    public function getAll() {
        $query = $this->db->query('SELECT * FROM apprenants ORDER BY id DESC');
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getByCohorteId($cohorte_id) {
        $query = $this->db->prepare('SELECT * FROM apprenants WHERE cohorte_id = ? ORDER BY nom, prenom');
        $query->execute([$cohorte_id]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function add($data) {
        $query = $this->db->prepare('INSERT INTO apprenants (nom, prenom, tel, email, adresse, image, cohorte_id) VALUES (?, ?, ?, ?, ?, ?, ?)');
        return $query->execute([
            $data['nom'],
            $data['prenom'],
            $data['tel'],
            $data['email'],
            $data['adresse'],
            $data['image'] ?? null,
            $data['cohorte_id']
        ]);
    }

    public function update($id, $data) {
        $query = $this->db->prepare('UPDATE apprenants SET nom = ?, prenom = ?, tel = ?, email = ?, adresse = ?, image = ?, cohorte_id = ? WHERE id = ?');
        return $query->execute([
            $data['nom'],
            $data['prenom'],
            $data['tel'],
            $data['email'],
            $data['adresse'],
            $data['image'] ?? null,
            $data['cohorte_id'],
            $id
        ]);
    }

    public function delete($id) {
        $query = $this->db->prepare('DELETE FROM apprenants WHERE id = ?');
        return $query->execute([$id]);
    }

    public function getById($id) {
        $query = $this->db->prepare('SELECT * FROM apprenants WHERE id = ?');
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
}