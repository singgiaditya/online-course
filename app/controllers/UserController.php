<?php 
namespace App\Controllers;

require_once 'app/models/courseModel.php';
require_once 'app/models/UserModel.php';

use App\Models\CourseModel;
use App\Models\UserModel;
use Controller;

class UserController extends Controller{
    public function index(){
        // $courseModel = new CourseModel();
        // $userModel = new UserModel();

        // $course = $courseModel->getAllCourse();
        // $user = $userModel->getAllUser();

        // $course = count($course);

        // $data = 
        // [
        //     'course' => $course,
        //     'user' => $user,
        // ];
        $this->view('user/Home');
    }
}