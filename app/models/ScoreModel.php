<?php

namespace App\Models;

require_once 'app/core/Database.php';

use Database;
use PDOException;

class ScoreModel{
    private $table = 'scores';

    private $db;
    
    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllScores() : array {
        $this->db->query('SELECT * FROM '.$this->table);
        return $this->db->resultSet();
    }

    public function getScoresByIdModule($id, $idUser) {
        $this->db->query('SELECT * FROM scores WHERE id_module = :id AND id_user  = :id_user');
        $this->db->bind(':id', $id);
        $this->db->bind(':id_user', $idUser);
        return $this->db->single();
    }

    public function addScore($idModule, $idUser, $score) : bool {
        $query = "INSERT INTO scores (`id_module`, `id_user`, `score`) VALUES (:module, :user, :score)";
        $this->db->query($query);
        $this->db->bind(":module", $idModule);
        $this->db->bind(":user", $idUser);
        $this->db->bind(":score", $score);
        try {
            $this->db->execute();
        } catch(PDOException $e){
            return false;
        }
        return true;
    }


    public function editScore($id, $score) : bool {
        try {
            $query = "UPDATE scores SET score = :score WHERE id = :id";
            $this->db->query($query);
            $this->db->bind(":score", $score);
            $this->db->bind("id", $id);
            $this->db->execute();
        } catch (PDOException $e) {
            return false;
        }
        return true;
    }


}
