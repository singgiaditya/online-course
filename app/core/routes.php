<?php

require_once 'router.php';
require_once 'app/controllers/HomeController.php';
require_once 'app/controllers/AdminController.php';
require_once 'app/controllers/AuthController.php';

use App\Controllers\HomeController;
use App\Controllers\AdminController;
use App\Controllers\AuthController;



$router = new Router();
$router->get('/', [HomeController::class, 'index']);


//admin
$router->get('/admin/dashboard', [AdminController::class, 'index']);

//admin-category
$router->get('/admin/category', [AdminController::class, 'categoryView']);
$router->post('/admin/category', [AdminController::class, 'addCategory']);
$router->post('/admin/category/delete', [AdminController::class, 'deleteCategory']);
$router->post('/admin/category/edit', [AdminController::class, 'editCategory']);

//admin-course
$router->get('/admin/course', [AdminController::class, 'courseView']);
$router->get('/admin/course/create', [AdminController::class, 'courseCreateView']);
$router->post('/admin/course/create', [AdminController::class, 'addCourse']);
$router->get('/admin/course/{id}', [AdminController::class, 'courseEditView']);
$router->post('/admin/course/delete', [AdminController::class, 'deleteCourse']);


//auth
$router->get('/login', [AuthController::class, 'loginView']);
$router->post('/login', [AuthController::class, 'login']);
$router->get('/register', [AuthController::class, 'registerView']);
$router->post('/register', [AuthController::class, 'register']);



//example of dynamic routing
// $router->get('/user/{id}', function($params) {
//     echo "User ID: " . $params['id'];
// });

// $router->get('/post/{id}/comment/{commentId}', function($params) {
//     echo "Post ID: " . $params['id'] . ", Comment ID: " . $params['commentId'];
// });

// Rute dengan middleware autentikasi
// $router->get('/user/{id}', function($params) {
//     echo "User ID: " . $params['id'];
// }, [new AuthMiddleware()]);


$router->run();