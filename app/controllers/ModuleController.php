<?php 
namespace App\Controllers;

require_once 'app/models/UserModel.php';
require_once 'app/models/CategoryModel.php';
require_once 'app/models/CourseModel.php';
require_once 'app/models/ModuleModel.php';

use Controller;

use App\Models\CourseModel;
use App\Models\ModuleModel;

class ModuleController extends Controller{

    public function index($params){
        $courseModels = new CourseModel();
        $course = $courseModels->getCourseById($params['id']);
        
        $moduleModels = new ModuleModel();
        $modules = $moduleModels->getAllModuleByIdCourse($params['id']);

        $data = 
        [
            'course' => $course,
            'modules' => $modules
        ];

        
        $this->view('admin/module', $data);
    }

    public function addNewModule($params){
        $module = new ModuleModel();

        $title = $_POST['title'];
        $video = $_POST['video'];
        $idCourse = $params['id'];

        if ($_FILES['content']['name'] != '') {
            // Direktori tempat menyimpan gambar yang diunggah
            $target_dir = basename(__DIR__)."/../public/storage/";

            // Ambil informasi file yang diunggah
            $file = $_FILES['content'];
            $file_name = $file['name'];
            $file_tmp = $file['tmp_name'];
            $file_size = $file['size'];
            $file_error = $file['error'];

            // Ekstrak ekstensi file
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            // Nama baru untuk file yang diunggah
            $new_file_name = uniqid('module_', true) . '.' . $file_ext;
            $target_file = $target_dir . $new_file_name;

            // Validasi file
            $allowed_ext = array('pdf');
            if (in_array($file_ext, $allowed_ext)) {
                if ($file_error === 0) {
                    if ($file_size <= 2 * 1024 * 1024) { // Batas ukuran file 2MB
                        // Pindahkan file ke direktori tujuan
                        if (move_uploaded_file($file_tmp, $target_file)) {
                            if ( $module->addModule($idCourse, $title, $new_file_name, $video) ) {
                                header("Location:/OnlineCourse/admin/course/$idCourse/module");
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

    public function deleteModules($params){
        $id_course = $params['id'];
        $module = new ModuleModel();
        $id = $_POST['delete'];
        

        $module->deleteModules($id);

        header("location:/onlineCourse/admin/course/$id_course/module");
    }

    public function editModule($params){
        $idCourse = $params['id'];
        $id = $_POST['id'];
        $title = $_POST['title'];
        $video = $_POST['video'];
        $module = new ModuleModel();

        if ($_FILES['content']['name'] != '') {
            // Direktori tempat menyimpan gambar yang diunggah
            $target_dir = basename(__DIR__)."/../public/storage/";

            // Ambil informasi file yang diunggah
            $file = $_FILES['content'];
            $file_name = $file['name'];
            $file_tmp = $file['tmp_name'];
            $file_size = $file['size'];
            $file_error = $file['error'];

            // Ekstrak ekstensi file
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            // Nama baru untuk file yang diunggah
            $new_file_name = uniqid('module_', true) . '.' . $file_ext;
            $target_file = $target_dir . $new_file_name;

            // Validasi file
            $allowed_ext = array('pdf');
            if (in_array($file_ext, $allowed_ext)) {
                if ($file_error === 0) {
                    if ($file_size <= 2 * 1024 * 1024) { // Batas ukuran file 2MB
                        // Pindahkan file ke direktori tujuan
                        if (move_uploaded_file($file_tmp, $target_file)) {
                            if ( $module->editModule($id ,$idCourse, $title, $new_file_name, $video) ) {
                                header("Location:/OnlineCourse/admin/course/$idCourse/module");
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
            if($module->editModuleWithoutContent($id, $idCourse, $title, $video)){
                header("Location:/OnlineCourse/admin/course/$idCourse/module");
            }else{
                echo "terjadi kesalahan saat upload pada database";
            }
        }

        
    }
}