<?php 
namespace App\Controllers;

require_once 'app/models/UserModel.php';

use Controller;
use App\Models\UserModel;

class AdminController extends Controller{
    public function index(){
        $userModel = new UserModel();
        $users = $userModel->getAllUser();

        $params = [
           'users' => $users, 
           'test' => 'anjay mabar' 
        ];

        $this->view('Test', $params);
    }
}