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

        

        header("location: ./category");
    }

    

}