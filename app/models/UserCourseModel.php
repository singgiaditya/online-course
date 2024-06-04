<?php

namespace App\Models;

require_once 'app/core/Database.php';

use Database;
use PDOException;

class UserCourseModel{
    private $table = 'user_course';

    private $db;
    
    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllUserCourse() : array {
        $this->db->query('SELECT * FROM '.$this->table);
        return $this->db->resultSet();
    }

    public function addUserCourse($idCourse, $idUser ) : bool {
        $query = "INSERT INTO user_course (`id_course`, `id_user`, `status`) VALUES (:id_course, :id_user, :status)";
        $this->db->query($query);
        $this->db->bind(":id_course", $idCourse);
        $this->db->bind(":id_user", $idUser);
        $this->db->bind(":status", 'uncomplete');
        try {
            $this->db->execute();
        } catch(PDOException $e){
            return false;
        }
        return true;
    }

    public function checkUserCourse($idUser, $idCourse) : array{
        $this->db->query('SELECT * FROM '.$this->table.' WHERE id_user = :id_user AND id_course = :id_course');
        $this->db->bind(":id_user", $idUser);
        $this->db->bind(":id_course", $idCourse);
        return $this->db->resultSet();
    }

    public function getUserCourse($id) : array {
        $this->db->query('SELECT user_course.id, course.title, course.description, course.picture, category.category FROM user_course, course, category 
                        WHERE user_course.id_course = course.id AND course.id_category = category.id AND id_user = :id');
        $this->db->bind(':id', $id);
        return $this->db->resultSet();
    }


}
