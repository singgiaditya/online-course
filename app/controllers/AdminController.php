<?php 
namespace App\Controllers;

require_once 'app/models/courseModel.php';
require_once 'app/models/UserModel.php';
require_once 'app/models/TransactionModel.php';

use App\Models\CourseModel;
use App\Models\TransactionModel;
use App\Models\UserModel;
use Controller;

class AdminController extends Controller{
    public function index(){
        $courseModel = new CourseModel();
        $userModel = new UserModel();
        $transactionModel = new TransactionModel();

        $course = $courseModel->getAllCourse();
        $user = $userModel->getAllUser();

        $transaction = $transactionModel->getAllTransaction();

        $course = count($course);

        $data = 
        [
            'course' => $course,
            'user' => $user,
            'transaction' => $transaction
        ];
        $this->view('admin/dashboard', $data);
    }
}