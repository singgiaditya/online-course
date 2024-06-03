<?php 
namespace App\Controllers;


require_once('app/models/ModuleModel.php');
require_once('app/models/QuizModel.php');

use Controller;

use App\Models\ModuleModel;
use App\Models\QuizModel;

class QuizController extends Controller{
    public function index($params){
        $module = new ModuleModel();
        $module = $module->getModuleById($params['module']);
        $quiz = new QuizModel();
        $quiz = $quiz->getAllQuizByIdModule($params['module']);
        $data = 
        [
            'module' => $module,
            'quiz' => $quiz,
            'course' => $params['id']
        ];

        $this->view('admin/quiz', $data);
    }

    public function addQuiz($params){
        $quiz = new QuizModel();
        $question = $_POST['question'];
        $quiz = $quiz->addQuiz($question, $params['module']);
        header('location: /onlineCourse/admin/course/'.$params['id'].'/module/'.$params['module'].'/quiz');
    }

    public function editQuiz($params){
        $quiz = new QuizModel();
        $id = $_POST['id'];
        $question = $_POST['question'];
        $quiz = $quiz->editQuiz($id ,$question);
        header('location: /onlineCourse/admin/course/'.$params['id'].'/module/'.$params['module'].'/quiz');
    }
}