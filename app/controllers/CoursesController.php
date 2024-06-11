<?php 
namespace App\Controllers;

require_once 'app/models/courseModel.php';
require_once 'app/models/UserModel.php';
require_once 'app/models/TransactionModel.php';
require_once 'app/models/UserCourseModel.php';
require_once 'app/models/ModuleModel.php';
require_once 'app/models/QuizModel.php';
require_once 'app/models/AnswerModel.php';
require_once 'app/models/ScoreModel.php';

use App\Models\CourseModel;
use App\Models\TransactionModel;
use App\Models\UserCourseModel;
use App\Models\ModuleModel;
use App\Models\QuizModel;
use App\Models\AnswerModel;
use App\Models\ScoreModel;
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

    public function submitQuiz($params){
        $scoreModel = new ScoreModel();
        $idModule = $_POST['module'];
        $idUser = $_SESSION['user']['id'];
        $answer = $_POST['answer'];

        $score = 100 / count($answer);

        $scores = 0;

        foreach ($answer as $value) {
            if ($value == 1) {
                $scores = $scores + $score;
            }
        }

        $checkScore = $scoreModel->getScoresByIdModule($idModule, $idUser);

        if ($checkScore) {
            $score = $scoreModel->editScore($checkScore['id'], $scores);
        }else{
            $score = $scoreModel->addScore($idModule, $idUser, $scores);
        }

        header('Location: /onlineCourse/my/course/'.$params['id']);

    }

    public function submitProject($params){
        $project = $_POST['project'];
        $id = $_POST['id'];

        $userCourseModel = new UserCourseModel();

        $result = $userCourseModel->submitProject($id, $project);
        header('Location: /onlineCourse/my/course/'.$params['id']);
    }

    public function myCourseDetail($params){

        $idCourse = $params['id'];
        $idUser = $_SESSION['user']['id'];
        
        $userCourseModel = new UserCourseModel();
        $moduleModel = new ModuleModel();
        $quizModel = new QuizModel();
        $answerModel = new AnswerModel();
        $scoreModel = new ScoreModel();


        

        $checkUser = $userCourseModel->checkUserCourse($idUser, $idCourse);
        $checkUser = count($checkUser);

        if ($checkUser < 1) {
            header('location:/onlineCourse/my/courses');
            die();
        }

        $course = $userCourseModel->getUserCourseById($idUser, $idCourse);
        $modules = $moduleModel->getAllModuleByIdCourse($idCourse);
        $question = [];
        $answer = [];
        $score = [];

        
        
        foreach ($modules as $key => $module) {
            $question[$key] = $quizModel->getAllQuizByIdModule($module['id']);
        }

        foreach($modules as $i => $module){
            foreach ($question[$i] as $key => $quiz) {
                    $answer[$i][$key] = $answerModel->getAllAnswerByIdQuiz($quiz['id']);
            }
        }

        foreach ($modules as $key => $module) {
            $value  = $scoreModel->getScoresByIdModule($module['id'], $idUser);
            if($value){

                array_push($score, $value['score']);
            }
        }
        
        $data = 
        [
            'course' => $course,
            'modules' => $modules,
            'question' => $question,
            'answer' => $answer,
            'scores' => $score,
            'id' => $params['id']
        ];

        $this->view('user/detail_my_course', $data);
    }

}