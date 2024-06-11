<?php

namespace App\Controllers;
use Controller;

require_once("app/models/UserModel.php");

use App\Models\UserModel;



class AuthController extends Controller{
    public function loginView(){
        $this->view('auth/Login');
    }

    public function registerView(){
        $this->view('auth/Register');
    }

    public function login()
    {
     $email = $_POST['email'];
     $password = $_POST['password'];

     $userModels = new UserModel();

     $user = $userModels->login($email, $password);

     if($user)
     {
        unset($user['password']);
        
        session_start();
        $_SESSION['user'] = $user;

        if($user['role'] == 'user')
        {
            header("location: ./");
            exit();
        }
        else if($user['role'] == 'admin'){
            header("location: ./admin/dashboard");
            exit();
        }else if($user['role'] == 'mentor'){
            header("location: /onlineCourse/mentor/dashboard");
            exit();
        }
        else
        {
            header("location: ./login?message=gagal user");
            exit();
        }
     }else
     {
        header("location:  ./login?message=gagal login");
        exit();
     }

    }
    
    public function register() 
    {
        $email = $_POST['email'];        
        $name = $_POST['name'];        
        $password = $_POST['password'];        
        $telephone = $_POST['telephone'];
        
        $userModels = new UserModel();

        $result = $userModels->register($email, $name, $password, $telephone);

        if ($result) {
            header('location: ./login?message=success');
            exit();
        }

        header('location: ./login?message=fail');

    }

    public function logout(){
        session_unset();
        session_destroy();
        header('Location:/onlineCourse/login');
    }
}
