<?php 
namespace App\Controllers;

require_once 'app/models/courseModel.php';
require_once 'app/models/UserModel.php';

use App\Models\CourseModel;
use App\Models\UserModel;
use Controller;

class ProfileController extends Controller{
    public function index(){ 
        $this->view('profile',);
    }

    public function editProfile(){
        $id = $_SESSION['user']['id'];
        $email = $_POST['email'];
        $name = $_POST['name'];
        $telephone = $_POST['telephone'];

        $userModel = new UserModel();
        
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
            $new_file_name = uniqid('pp_', true) . '.' . $file_ext;
            $target_file = $target_dir . $new_file_name;

            // Validasi file
            $allowed_ext = array('jpg', 'jpeg', 'png', 'gif');
            if (in_array($file_ext, $allowed_ext)) {
                if ($file_error === 0) {
                    if ($file_size <= 2 * 1024 * 1024) { // Batas ukuran file 2MB
                        // Pindahkan file ke direktori tujuan
                        if (move_uploaded_file($file_tmp, $target_file)) {
                            if ($userModel->editProfile($id, $name, $email, $telephone, $new_file_name)) {
                                $_SESSION['user']['name'] = $name;
                                $_SESSION['user']['email'] = $email;
                                $_SESSION['user']['telephone'] = $telephone;
                                $_SESSION['user']['picture'] = $new_file_name;
                                header("Location:/OnlineCourse/profile");
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
            $userModel->editProfileWithoutPicture($id, $name, $email, $telephone);
            $_SESSION['user']['name'] = $name;
            $_SESSION['user']['email'] = $email;
            $_SESSION['user']['telephone'] = $telephone;

            header("Location:/OnlineCourse/profile");
        }

    }
    
    public function changePassword(){
        $id = $_SESSION['user']['id'];
        $old_password = $_POST['old_password'];
        $new_password = $_POST['new_password'];

        $userModel = new UserModel();

        $user = $userModel->getUserById($id);

        if($user){
            if($user['password'] == $old_password){
                $userModel->changePassword($id, $new_password);
                header("Location:/OnlineCourse/profile");
            }else{
                header("Location:/OnlineCourse/profile");
            }
        }else{
            header("Location:/OnlineCourse/profile");
        }
    }
}