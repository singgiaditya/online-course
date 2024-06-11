<?php

namespace App\Models;

require_once 'app/core/Database.php';

use Database;
use PDOException;

class CommentModel{
    private $table = 'comment';

    private $db;
    
    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllComment() : array {
        $this->db->query('SELECT * FROM '.$this->table);
        return $this->db->resultSet();
    }

    public function getAllCommentByIdPost($idForum) : array {
        $this->db->query('SELECT comment.*, user.name, user.picture, user.role FROM comment, user WHERE comment.id_user = user.id AND comment.id_forum = :id_forum');
        $this->db->bind(':id_forum', $idForum);
        return $this->db->resultSet();
    }

    public function addComment($idUser, $idPost, $comment) : bool {
        $query = "INSERT INTO comment (`id_forum`, `id_user`, `comment`) VALUES (:id_forum, :id_user, :comment)";
        $this->db->query($query);
        $this->db->bind(":id_forum", $idPost);
        $this->db->bind(":id_user", $idUser);
        $this->db->bind(":comment", $comment);
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
