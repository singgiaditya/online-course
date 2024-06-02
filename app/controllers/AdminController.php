<?php 
namespace App\Controllers;

use Controller;

class AdminController extends Controller{
    public function index(){
        $this->view('admin/dashboard');
    }
}