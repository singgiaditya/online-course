<?php 
namespace App\Controllers;

require_once 'app/models/UserModel.php';
require_once 'app/models/CategoryModel.php';

use Controller;
use App\Models\UserModel;
use App\Models\CategoryModel;

class AdminController extends Controller{
    public function index(){
        $this->view('admin/dashboard');
    }

    public function categoryView(){
        $category = new CategoryModel();
        $data = $category->getAllCategory();
        $this->view('admin/category', $data);
    }

    public function addCategory(){
        $category = $_POST['category'];
        
        $model = new CategoryModel;
        
        $result = $model->addCategory($category);

        header("location: ./category");
    }

    public function deleteCategory(){
        $id = $_POST['id'];
        
        $model = new CategoryModel;
        
        $result = $model->deleteCategory($id);

        if($result){
            $return = array(
                'status' => 200,
                'message' => "OK"
            );
            http_response_code(200);
        } else {
            $return = array(
                'status' => 403,
                'message' => "Failed"
            );
            http_response_code(403);
        }
        echo json_encode($return);
    }

    public function editCategory(){
        $id = $_POST['id'];
        $category = $_POST['category'];

        $categoryModel = new CategoryModel();
        
        $result = $categoryModel->editCategory($id, $category);

        header("Location:http://localhost/onlineCourse/admin/category");
    }

    

}