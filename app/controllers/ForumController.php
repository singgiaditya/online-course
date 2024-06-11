<?php 
namespace App\Controllers;

require_once 'app/models/courseModel.php';
require_once 'app/models/UserModel.php';
require_once 'app/models/UserCourseModel.php';
require_once 'app/models/ModuleModel.php';
require_once 'app/models/QuizModel.php';
require_once 'app/models/AnswerModel.php';
require_once 'app/models/ScoreModel.php';
require_once 'app/models/ForumModel.php';
require_once 'app/models/CommentModel.php';

use App\Models\CourseModel;
use App\Models\UserCourseModel;
use App\Models\ModuleModel;
use App\Models\QuizModel;
use App\Models\AnswerModel;
use App\Models\ScoreModel;
use App\Models\ForumModel;
use App\Models\CommentModel;
use Controller;

class ForumController extends Controller{

    public function index($params){
        $courseModel = new CourseModel();
        

        $course = $courseModel->getAllCourse();

        $data = 
        [
            'courses' => $course,
            'id' => $params['id']
        ];


        $this->view('user/courses', $data);
    }

    public function courseForum($params){
        $forumModel = new ForumModel();
        $forum = $forumModel->getAllForumByIdCourse($params['id']);

        $data = 
        [
            'forum' => $forum,
            'id' => $params['id']
        ];
        $this->view('user/forum', $data);
    }

    public function detailForum($params){
        $idForum = $params['forum'];
        $forumModel = new ForumModel();
        $commentModel = new CommentModel();

        $forum = $forumModel->getForumById($idForum);
        $comment = $commentModel->getAllCommentByIdPost($idForum);

        $data = [
            'forum' => $forum,
            'comments' => $comment
        ];
        $this->view('user/detail_forum', $data);
    }

    public function addPost($params){
        $idCourse = $_POST['id_course'];
        $idUser = $_SESSION['user']['id'];
        $post = $_POST['post'];

        $forumModel = new ForumModel();
        $forum = $forumModel->addPost($idCourse, $idUser, $post);
        header("Location: /onlineCourse/course/$idCourse/forum");
    }
    
    public function addComment($params){
        $idCourse = $_POST['id_course'];
        $idUser = $_SESSION['user']['id'];
        $comment = $_POST['comment'];

        $commentModel = new CommentModel();
        $comment = $commentModel->addComment($idUser, $idCourse, $comment);
        header("Location: /onlineCourse/course/$idCourse/forum/".$params['forum']);
    }

    public function editPost($params){
        $id = $_POST['id'];
        $post = $_POST['post'];

        $forumModel = new ForumModel();
        $result = $forumModel->editPost($id, $post);

        header("Location: /onlineCourse/course/".$params['id']."/forum/".$params['forum']);

    } 

    public function deletePost($params){
        $id = $params['forum'];
        $forumModel = new ForumModel();
        $result = $forumModel->deletePost($id);

        header("Location: /onlineCourse/course/".$params['id']."/forum");

    }

}