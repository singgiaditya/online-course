<?php 
namespace App\Controllers;


require_once('app/models/ModuleModel.php');
require_once('app/models/QuizModel.php');
require_once('app/models/AnswerModel.php');

use Controller;

use App\Models\ModuleModel;
use App\Models\QuizModel;
use App\Models\AnswerModel;

class AnswerController extends Controller{
    public function getAnswerByIdQuiz(){
        $answer = new AnswerModel();
    }

    public function addAnswer($params){
        $answerModel =  new AnswerModel();
        $answer = $_POST['answer'];
        $correct = $_POST['correct'];
        $idQuiz = $_POST['id_quiz'];
        $result = $answerModel->addAnswer($idQuiz,$answer, $correct);
        header('location: /onlineCourse/admin/course/'.$params['id'].'/module/'.$params['module'].'/quiz');
    }

    public function editAnswer($params){
        $answerModel = new AnswerModel();
        $id = $_POST['id'];
        $answer = $_POST['answer'];
        $correct = $_POST['correct'];
        $result = $answerModel->editAnswer($id, $answer, $correct);
        header('location: /onlineCourse/admin/course/'.$params['id'].'/module/'.$params['module'].'/quiz');
    }
    
    public function deleteAnswer($params){
        $answerModel = new AnswerModel();
        $id = $_GET['id'];
        $result = $answerModel->deleteAnswer($id);
        header('location: /onlineCourse/admin/course/'.$params['id'].'/module/'.$params['module'].'/quiz');
    }
}