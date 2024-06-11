<?php 
namespace App\Controllers;

require_once 'app/models/courseModel.php';
require_once 'app/models/UserModel.php';
require_once 'app/models/userCourseModel.php';
require_once 'app/models/ForumModel.php';

use App\Models\CourseModel;
use App\Models\UserCourseModel;
use App\Models\UserModel;
use App\Models\ForumModel;
use Controller;

class UserController extends Controller{
    public function index(){
        $userCourse = new UserCourseModel();
        $forumModel = new ForumModel();

        $courses = $userCourse->getAllUserCourse();
        $forum = $forumModel->getForumByIdUser($_SESSION['user']['id']);

        $courseComplete = 0;
        $courseUncomplete = 0;
        
        $post = count($forum);

        foreach ($courses as $key => $course) {
            if ($course['status'] == 'complete') {
                $courseComplete++;
            }

            if ($course['status'] == 'uncomplete') {
                $courseUncomplete++;
            }
        }

        

        $data = 
        [
            'courses' => $courses,
            'courseComplete' => $courseComplete,
            'courseUncomplete' => $courseUncomplete,
            'post' => $post
        ];

        $this->view('user/Home', $data);
    }
}