<?php 
namespace App\Controllers;

require_once 'app/models/courseModel.php';
require_once 'app/models/UserCourseModel.php';
require_once 'app/models/UserModel.php';

use App\Models\CourseModel;
use App\Models\UserModel;
use App\Models\UserCourseModel;
use Controller;

class MentorController extends Controller{
    public function index(){
        $userCourseModel = new UserCourseModel();
        $userCourse = $userCourseModel->getAllUserCourse();
        $data = [
            'user_courses' => $userCourse
        ];
        $this->view('mentor/dashboard', $data);
    }

    public function updateStatusCourse(){
        $idUserCourse = $_POST['id_user_course'];
        $status = $_POST['status'];
        $userCourseModel = new UserCourseModel();
        foreach ($idUserCourse as $key => $id) {
            $result = $userCourseModel->updateStatus($id, $status[$key]);
        }

        header('Location:/onlineCourse/mentor/dashboard');       
    }

    public function listForum(){
        $courseModel = new CourseModel();
        $course = $courseModel->getAllCourse();
        $data = [
            'courses' => $course
        ];

        $this->view('mentor/list_forum', $data);
    }
}