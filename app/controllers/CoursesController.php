<?php 
namespace App\Controllers;

require_once 'app/models/courseModel.php';
require_once 'app/models/UserModel.php';
require_once 'app/models/TransactionModel.php';
require_once 'app/models/UserCourseModel.php';

use App\Models\CourseModel;
use App\Models\TransactionModel;
use App\Models\UserCourseModel;
use Controller;

class CoursesController extends Controller{

    public function index(){
        $courseModel = new CourseModel();
        

        $course = $courseModel->getAllCourse();

        $data = 
        [
            'courses' => $course,
        ];


        $this->view('user/courses', $data);
    }

    public function courseDetail($params){
        $courseModel = new CourseModel();
        
        $course = $courseModel->getCourseById($params['id']);

        $data = 
        [
            'course' => $course,
        ];


        $this->view('user/detail_course', $data);
    }

    public function buyCourse(){

        $idCourse = $_POST['id'];
        $idUser = $_SESSION['user']['id'];

        $transactionModel = new TransactionModel();
        $userCourseModel = new UserCourseModel();

        $checkUser = $userCourseModel->checkUserCourse($idUser, $idCourse);
        $checkUser = count($checkUser);

        if ($checkUser > 0) {
            header('location:/onlineCourse/course/'.$idCourse);
            die();
        }

        $transaction = $transactionModel->addTransaction($idCourse, $idUser);
        $userCourse = $userCourseModel->addUserCourse($idCourse, $idUser);

        header('location:/onlineCourse/course/'.$idCourse);
    }

    public function myCourse(){
        
        $UserCourseModel = new UserCourseModel();

        $courses = $UserCourseModel->getUserCourse($_SESSION['user']['id']);

        $data = 
        [
            'courses' => $courses,
        ];

        $this->view('user/my_courses', $data);
    }

}