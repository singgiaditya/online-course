<?php 
namespace App\Controllers;

require_once 'app/models/UserModel.php';
require_once 'app/models/CategoryModel.php';
require_once 'app/models/CourseModel.php';

use Controller;
use App\Models\CategoryModel;
use App\Models\CourseModel;

class ModuleController extends Controller{

    public function index($params){
        $courseModels = new CourseModel();
        $course = $courseModels->getCourseById($params['id']);

        $data = 
        [
            'course' => $course,
        ];

        
        $this->view('admin/module', $data);
    }
}