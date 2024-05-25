<?php

namespace App\Models;

require_once 'app/core/Database.php';

use Database;
use PDOException;

class CategoryModel{
    private $table = 'category';

    private $db;
    
    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllCategory(){
        $this->db->query('SELECT * FROM '.$this->table);
        return $this->db->resultSet();
    }

    public function deleteCategory($id){
        $query = "DELETE FROM category (`id`) VALUES (:id)";
        $this->db->query($query);
        $this->db->bind(":id", $id);
        try {
            $this->db->execute();
        } catch(PDOException $e){
            return false;
        }
        return true;
    }

    public function addCategory($category){
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
}
