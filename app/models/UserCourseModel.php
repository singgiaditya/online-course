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
        $this->db->query('SELECT user_course.id, user_course.final_project, user_course.status, user_course.id_course, course.title, course.description, course.picture, 
        category.category, user_course.id_user, user.name FROM user_course, course, category, user 
        WHERE user_course.id_course = course.id AND course.id_category = category.id AND user_course.id_user = user.id');
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
        $this->db->query('SELECT user_course.id, user_course.id_course, course.title, course.description, course.picture, category.category FROM user_course, course, category 
                        WHERE user_course.id_course = course.id AND course.id_category = category.id AND id_user = :id');
        $this->db->bind(':id', $id);
        return $this->db->resultSet();
    }

    public function getUserCourseById($idUser, $idCourse){
        $this->db->query('SELECT user_course.id, user_course.id_course, course.title, course.description, course.picture, category.category, user_course.final_project, user_course.`status` FROM user_course, course, category WHERE user_course.id_course = course.id 
                        AND course.id_category = category.id AND id_user = :id_user AND course.id = :id_course');
        $this->db->bind(':id_user', $idUser);
        $this->db->bind(':id_course', $idCourse);
        return $this->db->single();
    }

    public function submitProject($id, $project){
        $this->db->query('UPDATE user_course set final_project = :project, status = :status where id = :id');
        $this->db->bind(':id', $id);
        $this->db->bind(':project', $project);
        $this->db->bind(':status', 'review');
        try {
            $this->db->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function updateStatus($id, $status){
        $this->db->query('UPDATE user_course set status = :status where id = :id');
        $this->db->bind(':id', $id);
        $this->db->bind(':status', $status);
        try {
            $this->db->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }


}
