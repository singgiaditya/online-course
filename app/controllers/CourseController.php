<?php 
namespace App\Controllers;

require_once 'app/models/CategoryModel.php';
require_once 'app/models/CourseModel.php';

use Controller;
use App\Models\CategoryModel;
use App\Models\CourseModel;

class CourseController extends Controller{

    public function index(){
        $course = new CourseModel();
        $courses = $course->getAllCourse();
        
        $data = [
            'courses' => $courses,
        ];
        $this->view('admin/course/course', $data);
    }

    public function courseCreateView(){
        $category = new CategoryModel();
        $dataCategory = $category->getAllCategory();

        $this->view('admin/course/create_course', $dataCategory);
    }

    public function courseEditView($id){
        $category = new CategoryModel();
        $categories = $category->getAllCategory();

        $courseModel = new CourseModel();
        $course = $courseModel->getCourseById($id['id']);

        $data = 
        [
            'course' => $course,
            'categories' => $categories 
        ];



        $this->view('admin/course/edit_course', $data);
    }

    public function addCourse(){
        $course = new CourseModel();
        
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category = $_POST['category'];

        if ($_FILES['image']['name'] != '') {
            // Direktori tempat menyimpan gambar yang diunggah
            $target_dir = basename(__DIR__)."/../public/storage/";

            // Ambil informasi file yang diunggah
            $file = $_FILES['image'];
            $file_name = $file['name'];
            $file_tmp = $file['tmp_name'];
            $file_size = $file['size'];
            $file_error = $file['error'];

            // Ekstrak ekstensi file
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            // Nama baru untuk file yang diunggah
            $new_file_name = uniqid('img_', true) . '.' . $file_ext;
            $target_file = $target_dir . $new_file_name;

            // Validasi file
            $allowed_ext = array('jpg', 'jpeg', 'png', 'gif');
            if (in_array($file_ext, $allowed_ext)) {
                if ($file_error === 0) {
                    if ($file_size <= 2 * 1024 * 1024) { // Batas ukuran file 2MB
                        // Pindahkan file ke direktori tujuan
                        if (move_uploaded_file($file_tmp, $target_file)) {
                            if ($course->addCourse($title, $description, $price, $category, $new_file_name)) {
                                header("Location:/OnlineCourse/admin/course");
                            }else{
                                echo "terjadi kesalahan saat upload pada database";
                            }
                        } else {
                            echo "Terjadi kesalahan saat mengunggah file.";
                        }
                    } else {
                        echo "Ukuran file terlalu besar. Maksimal 2MB.";
                    }
                } else {
                    echo "Terjadi kesalahan saat mengunggah file. Kode error: " . $file_error;
                }
            } else {
                echo "Ekstensi file tidak diizinkan. Hanya JPG, JPEG, PNG, dan GIF yang diperbolehkan.";
            }
        } else {
            echo "Tidak ada file yang diunggah.";
        }
    }

    public function deleteCourse(){
        $courses = $_POST['delete'];
        $courseModel = new CourseModel();
        $result = $courseModel->deleteCourses($courses);
        if($result){
            header("Location: /onlineCourse/admin/course");
        }else{
            header("Location: /onlineCourse/admin/course");
        }
    }

    public function editCourse($params){
        $course = new CourseModel();
        
        $id = $params['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category = $_POST['category'];

        if ($_FILES['image']['name'] != '') {
            $target_dir = basename(__DIR__)."/../public/storage/";

            // Ambil informasi file yang diunggah
            $file = $_FILES['image'];
            $file_name = $file['name'];
            $file_tmp = $file['tmp_name'];
            $file_size = $file['size'];
            $file_error = $file['error'];
    
            // Ekstrak ekstensi file
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    
            // Nama baru untuk file yang diunggah
            $new_file_name = uniqid('img_', true) . '.' . $file_ext;
            $target_file = $target_dir . $new_file_name;
    
            // Validasi file
            $allowed_ext = array('jpg', 'jpeg', 'png', 'gif');
            if (in_array($file_ext, $allowed_ext)) {
                if ($file_error === 0) {
                    if ($file_size <= 2 * 1024 * 1024) { // Batas ukuran file 2MB
                        // Pindahkan file ke direktori tujuan
                        if (move_uploaded_file($file_tmp, $target_file)) {
                            if ($course->editCourse($title, $description, $price, $category, $new_file_name, $id)) {
                                header("Location:/OnlineCourse/admin/course");
                            }else{
                                echo "terjadi kesalahan saat upload pada database";
                            }
                        } else {
                            echo "Terjadi kesalahan saat mengunggah file.";
                        }
                    } else {
                        echo "Ukuran file terlalu besar. Maksimal 2MB.";
                    }
                } else {
                    echo "Terjadi kesalahan saat mengunggah file. Kode error: " . $file_error;
                }
            } else {
                echo "Ekstensi file tidak diizinkan. Hanya JPG, JPEG, PNG, dan GIF yang diperbolehkan.";
            }
        }else{
            if ($course->editCourseWithoutPicture($title, $description, $price, $category, $id)) {
                header("Location:/OnlineCourse/admin/course");
            }else{
                echo "terjadi kesalahan saat upload pada database";
            }
        }
    }
}