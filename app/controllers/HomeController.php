<?php

namespace App\Controllers;
use Controller;

class HomeController extends Controller{
    public function index(){
        var_dump( $_SESSION['user']);
        $this->view('Home');
    }
}