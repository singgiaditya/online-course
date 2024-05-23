<?php

namespace App\Models;

require_once 'app/core/Database.php';

use Database;

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
            return true;
        } catch (\Throwable $th) {
            return $th;
        }

    }

    public function login($email, $password)
    {
        $query = "SELECT * FROM $this->table where email = :email AND password = :password";
        $this->db->query($query);
        $this->db->bind('email', $email);
        $this->db->bind('password', $password);
        
        return $this->db->single();
    }
}
