<?php

namespace App\Models;

require_once 'app/core/Database.php';

use Database;
use PDOException;

class ForumModel{
    private $table = 'module';

    private $db;
    
    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllForum() : array {
        $this->db->query('SELECT * FROM '.$this->table);
        return $this->db->resultSet();
    }

    public function getAllForumByIdCourse($id_course) : array {
        $this->db->query('SELECT forum.*, user.name, user.picture FROM forum, user WHERE forum.id_user = user.id and forum.id_course = :id_course');
        $this->db->bind(':id_course', $id_course);
        return $this->db->resultSet();
    }

    public function getForumById($id) {
        $this->db->query('SELECT forum.*, user.name, user.picture FROM forum, user WHERE forum.id_user = user.id and forum.id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function getForumByIdUser($id) : array {
        $this->db->query('SELECT forum.*, user.name, user.picture FROM forum, user WHERE forum.id_user = user.id and forum.id_user = :id');
        $this->db->bind(':id', $id);
        return $this->db->resultSet();
    }
    


    public function addPost($idCourse, $idUser, $post) : bool {
        $query = "INSERT INTO forum (`id_course`, `id_user`, `post`) VALUES (:id_course, :id_user, :post)";
        $this->db->query($query);
        $this->db->bind(":id_course", $idCourse);
        $this->db->bind(":id_user", $idUser);
        $this->db->bind(":post", $post);
        try {
            $this->db->execute();
        } catch(PDOException $e){
            return false;
        }
        return true;
    }

    public function deletePost($id) : bool{
        try {
                $query = "DELETE from forum  WHERE id = :id";
                $this->db->query($query);
                $this->db->bind(":id", $id);
                $this->db->execute();
        } catch (PDOException $e) {
            return false;
        }

        return true;
    }
    

    public function editPost($id, $post) : bool {
        $query = "UPDATE forum SET post = :post  WHERE id = :id";
        $this->db->query($query);
        $this->db->bind(":post", $post);
        $this->db->bind("id", $id);
        try {
            $this->db->execute();
        } catch (PDOException $e) {
            return false;
        }
        return true;
    }

    

}
