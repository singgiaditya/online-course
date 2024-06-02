<?php

require_once 'router.php';
require_once 'app/controllers/HomeController.php';
require_once 'app/controllers/AdminController.php';
require_once 'app/controllers/AuthController.php';
require_once 'app/controllers/CategoryController.php';
require_once 'app/controllers/CourseController.php';
require_once 'app/controllers/ModuleController.php';
require_once 'app/middleware/AuthMiddleware.php';
require_once 'app/middleware/AdminMiddleware.php';

use App\Controllers\CategoryController;
use App\Controllers\HomeController;
use App\Controllers\AdminController;
use App\Controllers\AuthController;
use App\Controllers\CourseController;
use App\Controllers\ModuleController;
use App\Middleware\AuthMiddleware;
use App\Middleware\AdminMiddleware;



$router = new Router();
$router->get('/', [HomeController::class, 'index'], [new AuthMiddleware]);

//auth
$router->get('/login', [AuthController::class, 'loginView']);
$router->post('/login', [AuthController::class, 'login']);
$router->get('/register', [AuthController::class, 'registerView']);
$router->post('/register', [AuthController::class, 'register']);
$router->get('/logout', [AuthController::class, 'logout'], [new AuthMiddleware]);



//admin
$router->get('/admin/dashboard', [AdminController::class, 'index'], [new AuthMiddleware, new AdminMiddleware]);

//admin-category
$router->get('/admin/category', [CategoryController::class, 'index'], [new AuthMiddleware, new AdminMiddleware]);
$router->post('/admin/category', [CategoryController::class, 'addCategory'], [new AuthMiddleware, new AdminMiddleware]);
$router->post('/admin/category/delete', [CategoryController::class, 'deleteCategory'], [new AuthMiddleware, new AdminMiddleware]);
$router->post('/admin/category/edit', [CategoryController::class, 'editCategory'], [new AuthMiddleware, new AdminMiddleware]);

//admin-course
$router->get('/admin/course', [CourseController::class, 'index'], [new AuthMiddleware, new AdminMiddleware]);
$router->get('/admin/course/create', [CourseController::class, 'courseCreateView'], [new AuthMiddleware, new AdminMiddleware]);
$router->post('/admin/course/create', [CourseController::class, 'addCourse'], [new AuthMiddleware, new AdminMiddleware]);
$router->get('/admin/course/{id}', [CourseController::class, 'courseEditView'], [new AuthMiddleware, new AdminMiddleware]);
$router->post('/admin/course/{id}', [CourseController::class, 'editCourse'], [new AuthMiddleware, new AdminMiddleware]);
$router->post('/admin/course/delete', [CourseController::class, 'deleteCourse'], [new AuthMiddleware, new AdminMiddleware]);

//admin-module
$router->get('/admin/course/{id}/module', [ModuleController::class, 'moduleView'], [new AuthMiddleware, new AdminMiddleware]);






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