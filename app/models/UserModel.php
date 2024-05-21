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

    public function register($nama){
        $query = "INSERT INTO user ('email','name', 'password', 'telephone', 'role') VALUES (:email, :name, :password, :telephone, :role)";
        $this->db->query($query);
        $this->db->bind("nama", $nama);
    }
}
