<?php

namespace App\Models;

require_once 'app/core/Database.php';

use Database;
use PDOException;

class AnswerModel{
    private $table = 'answer';

    private $db;
    
    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllAnswer() : array {
        $this->db->query('SELECT * FROM '.$this->table);
        return $this->db->resultSet();
    }

    public function getAllAnswerByIdQuiz($id) : array {
        $this->db->query('SELECT * FROM '.$this->table.' where id_quiz = :id');
        $this->db->bind(':id' , $id);
        return $this->db->resultSet();
    }

    public function addAnswer($idQuiz, $answer, $isCorrect) : bool {
        $query = "INSERT INTO answer (`id_quiz`, `answer`, `correct`) VALUES (:id_quiz, :answer, :correct)";
        $this->db->query($query);
        $this->db->bind(":id_quiz", $idQuiz);
        $this->db->bind(":answer", $answer);
        $this->db->bind(":correct", $isCorrect);
        try {
            $this->db->execute();
        } catch(PDOException $e){
            return false;
        }
        return true;
    }

    public function deleteAnswer($id) : bool{
        $query = "DELETE from answer  WHERE id = :id";
        $this->db->query($query);
        $this->db->bind(":id", $id);
        try {
                $this->db->execute();
        } catch (PDOException $e) {
            return false;
        }

        return true;
    }

    public function deleteAnswerByIdQuiz($id) : bool{
        $query = "DELETE from answer  WHERE id_quiz = :id";
        $this->db->query($query);
        $this->db->bind(":id", $id);
        try {
                $this->db->execute();
        } catch (PDOException $e) {
            return false;
        }

        return true;
    }

    public function editAnswer($id, $answer, $correct) : bool {
        $query = "UPDATE answer SET answer = :answer, correct = :correct WHERE id = :id";
        $this->db->query($query);
        $this->db->bind(":answer", $answer);
        $this->db->bind(":correct", $correct);
        $this->db->bind("id", $id);
        try {
            $this->db->execute();
        } catch (PDOException $e) {
            return false;
        }
        return true;
    }

    

}
