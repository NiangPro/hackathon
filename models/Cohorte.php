<?php
class Cohorte {
    private $id;
    private $nom;
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=hackathon;charset=utf8', 'root', '');
    }

    public function getAll() {
        $query = $this->db->query('SELECT * FROM cohortes ORDER BY id DESC');
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function add($nom) {
        $query = $this->db->prepare('INSERT INTO cohortes (nom) VALUES (?)');
        return $query->execute([$nom]);
    }

    public function update($id, $nom) {
        $query = $this->db->prepare('UPDATE cohortes SET nom = ? WHERE id = ?');
        return $query->execute([$nom, $id]);
    }

    public function delete($id) {
        $query = $this->db->prepare('DELETE FROM cohortes WHERE id = ?');
        return $query->execute([$id]);
    }

    public function getById($id) {
        $query = $this->db->prepare('SELECT * FROM cohortes WHERE id = ?');
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
}