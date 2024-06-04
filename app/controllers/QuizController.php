<?php 
namespace App\Controllers;


require_once('app/models/ModuleModel.php');
require_once('app/models/QuizModel.php');
require_once('app/models/AnswerModel.php');

use Controller;

use App\Models\ModuleModel;
use App\Models\QuizModel;
use App\Models\AnswerModel;

class QuizController extends Controller{
    public function index($params){
        $module = new ModuleModel();
        $module = $module->getModuleById($params['module']);
        $quiz = new QuizModel();
        $quiz = $quiz->getAllQuizByIdModule($params['module']);

        $answerModel = new AnswerModel();

        $answer = [];

        foreach ($quiz as $key => $question) {
            array_push($answer, $answerModel->getAllAnswerByIdQuiz($question['id']));
        }


        $data = 
        [
            'module' => $module,
            'quiz' => $quiz,
            'course' => $params['id'],
            'answer' => $answer
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

    public function deleteQuiz($params){
        $quiz = new QuizModel();
        $answer = new AnswerModel();
        $id = $_GET['id'];
        $answer = $answer->deleteAnswerByIdQuiz($id);
        $quiz = $quiz->deleteQuiz($id);
        header('location: /onlineCourse/admin/course/'.$params['id'].'/module/'.$params['module'].'/quiz');
    }
}