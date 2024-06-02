<?php

namespace App\Models;

require_once 'app/core/Database.php';

use Database;
use PDOException;

class ModuleModel{
    private $table = 'module';

    private $db;
    
    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllModule() : array {
        $this->db->query('SELECT * FROM '.$this->table);
        return $this->db->resultSet();
    }

    public function getAllModuleByIdCourse($id) : array {
        $this->db->query('SELECT * FROM '.$this->table.' where id_course = :id');
        $this->db->bind(':id' , $id);
        return $this->db->resultSet();
    }

    public function addCategory($category) : bool {
        $query = "INSERT INTO category (`category`) VALUES (:category)";
        $this->db->query($query);
        $this->db->bind(":category", $category);
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
