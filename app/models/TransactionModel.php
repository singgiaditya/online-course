<?php

namespace App\Models;

require_once 'app/core/Database.php';

use Database;
use PDOException;

class TransactionModel{
    private $table = 'transaction';

    private $db;
    
    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllTransaction() : array {
        $this->db->query('SELECT * FROM '.$this->table);
        return $this->db->resultSet();
    }

    public function addTransaction($idCourse, $idUser ) : bool {
        $query = "INSERT INTO transaction (`id_course`, `id_user`) VALUES (:id_course, :id_user)";
        $this->db->query($query);
        $this->db->bind(":id_course", $idCourse);
        $this->db->bind(":id_user", $idUser);
        try {
            $this->db->execute();
        } catch(PDOException $e){
            return false;
        }
        return true;
    }

    public function deleteCategory($id) : bool{
        $query = "DELETE FROM category where id = :id";
        $this->db->query($query);
        $this->db->bind(":id", $id);
        try {
            $this->db->execute();
        } catch(PDOException $e){
            return false;
        }
        return true;
    }

    public function editCategory($id, $category) : bool {
        try {
            foreach ($id as $index => $value) {
                $query = "UPDATE category SET category = :category WHERE id = :id";
                $this->db->query($query);
                $this->db->bind("category", "$category[$index]");
                $this->db->bind("id", "$value");
                $this->db->execute();
            }
        } catch (PDOException $e) {
            return false;
        }

        return true;
    }


}
