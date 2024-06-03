<?php

namespace App\Models;

require_once 'app/core/Database.php';

use Database;
use PDOException;

class QuizModel{
    private $table = 'quiz';

    private $db;
    
    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllQuiz() : array {
        $this->db->query('SELECT * FROM '.$this->table);
        return $this->db->resultSet();
    }

    public function getAllQuizByIdModule($id) : array {
        $this->db->query('SELECT * FROM '.$this->table.' where id_module = :id');
        $this->db->bind(':id' , $id);
        return $this->db->resultSet();
    }

    public function addQuiz($question, $idModule) : bool {
        $query = "INSERT INTO quiz (`question`, `id_module`) VALUES (:question, :id_module)";
        $this->db->query($query);
        $this->db->bind(":question", $question);
        $this->db->bind(":id_module", $idModule);
        try {
            $this->db->execute();
        } catch(PDOException $e){
            return false;
        }
        return true;
    }

    public function deleteModules($id) : bool{
        try {
            foreach ($id as $index => $value) {
                $query = "DELETE from module  WHERE id = :id";
                $this->db->query($query);
                $this->db->bind(":id", $value);
                $this->db->execute();
            }
        } catch (PDOException $e) {
            return false;
        }

        return true;
    }

    public function editQuiz($id, $question) : bool {
        $query = "UPDATE quiz SET question = :question WHERE id = :id";
        $this->db->query($query);
        $this->db->bind(":question", $question);
        $this->db->bind("id", $id);
        try {
            $this->db->execute();
        } catch (PDOException $e) {
            return false;
        }
        return true;
    }

    

}
