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

    public function getModuleById($id) {
        $this->db->query('SELECT * FROM '.$this->table.' where id = :id');
        $this->db->bind(':id' , $id);
        return $this->db->single();
    }

    public function addModule($idCourse, $title, $content, $video) : bool {
        $query = "INSERT INTO module (`id_course`, `title`, `content`, `video`) VALUES (:id_course, :title, :content, :video)";
        $this->db->query($query);
        $this->db->bind(":id_course", $idCourse);
        $this->db->bind(":title", $title);
        $this->db->bind(":content", $content);
        $this->db->bind(":video", $video);
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
    

    public function editModule($id, $idCourse, $title, $content, $video) : bool {
        $query = "UPDATE module SET id_course = :id_course, title = :title, content = :content, video = :video  WHERE id = :id";
        $this->db->query($query);
        $this->db->bind(":id_course", $idCourse);
        $this->db->bind(":title", $title);
        $this->db->bind(":content", $content);
        $this->db->bind(":video", $video);
        $this->db->bind("id", $id);
        try {
            $this->db->execute();
        } catch (PDOException $e) {
            return false;
        }
        return true;
    }

    public function editModuleWithoutContent($id, $idCourse, $title, $video) : bool {
        $query = "UPDATE module SET id_course = :id_course, title = :title, video = :video  WHERE id = :id";
        $this->db->query($query);
        $this->db->bind(":id_course", $idCourse);
        $this->db->bind(":title", $title);
        $this->db->bind(":video", $video);
        $this->db->bind("id", $id);
        try {
            $this->db->execute();
        } catch (PDOException $e) {
            return false;
        }
        return true;
    }

    

}
