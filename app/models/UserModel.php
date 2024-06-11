<?php

namespace App\Models;

require_once 'app/core/Database.php';

use Database;
use PDOException;

class UserModel{
    private $table = 'user';

    private $db;
    
    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllUser(){
        $this->db->query('SELECT * FROM '.$this->table);
        return $this->db->resultSet();
    }

    public function getUserById($id){
        $this->db->query('SELECT * FROM '.$this->table.' WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function register($email, $name, $password, $telephone){
        $query = "INSERT INTO user (`email`, `name`, `password`, `telephone`, `role`) VALUES (:email, :name, :password, :telephone, :role)";
        $this->db->query($query);
        $this->db->bind(":email", $email);
        $this->db->bind(":name", $name);
        $this->db->bind(":password", $password);
        $this->db->bind(":telephone", $telephone);
        $this->db->bind(":role", 'user');

        try {
            $this->db->execute();
        } catch(PDOException $e){
            return false;
        }

        return true;

    }

    public function login($email, $password)
    {
        $query = "SELECT * FROM $this->table where email = :email AND password = :password";
        $this->db->query($query);
        $this->db->bind('email', $email);
        $this->db->bind('password', $password);
        
        return $this->db->single();
    }

    public function editProfile($id, $name, $email, $telephone, $picture){
        $query = "UPDATE user SET `name` = :name, `email` = :email, `telephone` = :telephone, `picture` = :picture WHERE id = :id";
        $this->db->query($query);
        $this->db->bind(":email", $email);
        $this->db->bind(":name", $name);
        $this->db->bind(":telephone", $telephone);
        $this->db->bind(":picture", $picture);
        $this->db->bind(":id", $id);
        try {
            $this->db->execute();
        } catch(PDOException $e){
            return false;
        }

        return true;
    }

    public function editProfileWithoutPicture($id, $name, $email, $telephone){
        $query = "UPDATE user SET `name` = :name, `email` = :email, `telephone` = :telephone WHERE id = :id";
        $this->db->query($query);
        $this->db->bind(":email", $email);
        $this->db->bind(":name", $name);
        $this->db->bind(":telephone", $telephone);
        try {
            $this->db->execute();
        } catch(PDOException $e){
            return false;
        }

        return true;
    }

    public function changePassword($id, $password){
        $query = "UPDATE user SET `password` = :password WHERE id = :id";
        $this->db->query($query);
        $this->db->bind(":password", $password);
        $this->db->bind(":id", $id);

        try {
            $this->db->execute();
        } catch(PDOException $e){
            return false;
        }

        return true;
    }
}
