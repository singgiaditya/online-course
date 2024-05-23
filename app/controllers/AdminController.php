<?php 
namespace App\Controllers;

require_once 'app/models/UserModel.php';

use Controller;
use App\Models\UserModel;

class AdminController extends Controller{
    public function index(){
        $this->view('admin/dashboard');
    }
}