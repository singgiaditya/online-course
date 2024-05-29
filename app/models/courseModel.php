<?php

namespace App\Models;

require_once 'app/core/Database.php';

use Database;
use PDOException;

class CourseModel{
    private $table = 'course';

    private $db;
    
    public function __construct()
    {
        $this->db = new Database();
    }
    

    public function getAllCourse() : array {
        $this->db->query('SELECT * FROM '.$this->table);
        return $this->db->resultSet();
    }

    public function getCourseById($id) {
        $query = 'SELECT * FROM '.$this->table.' WHERE id = :id';
        $this->db->query($query);
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function getAllCourseCategory($course) : array {
        $categories = [];
        foreach ($course as $value) {
            $this->db->query('SELECT * FROM category where id = :id');
            $this->db->bind(':id', $value['id_category']);
            $category = $this->db->single();
            array_push($categories, $category);
        }
        return $categories;
    }

    public function addCourse($title, $description, $price, $category, $picture) : bool {
        $query = "INSERT INTO course (`title`, `description`, `price`, `id_category`, `picture`) VALUES (:title, :description, :price, :category, :picture)";
        $this->db->query($query);
        $this->db->bind(':title', $title);
        $this->db->bind(':description', $description);
        $this->db->bind(':price', $price);
        $this->db->bind(':category', $category);
        $this->db->bind(':picture', $picture);
        try {
            $this->db->execute();
        } catch(PDOException $e){
            return false;
        }
        return true;
    }

    public function deleteCourses($ids) : bool{
        try{
            foreach ($ids as $id) {
                $query = "DELETE FROM course where id = :id";
                $this->db->query($query);
                $this->db->bind(":id", $id);
                $this->db->execute();
            }
        }catch (PDOException $e){
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
