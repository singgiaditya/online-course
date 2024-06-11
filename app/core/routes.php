<?php

//controller
require_once 'router.php';
require_once 'app/controllers/UserController.php';
require_once 'app/controllers/AdminController.php';
require_once 'app/controllers/AuthController.php';
require_once 'app/controllers/CategoryController.php';
require_once 'app/controllers/CourseController.php';
require_once 'app/controllers/ModuleController.php';
require_once 'app/controllers/QuizController.php';
require_once 'app/controllers/AnswerController.php';
require_once 'app/controllers/CoursesController.php';
require_once 'app/controllers/ForumController.php';
require_once 'app/controllers/MentorController.php';
require_once 'app/controllers/ProfileController.php';

//middleware
require_once 'app/middleware/AuthMiddleware.php';
require_once 'app/middleware/AdminMiddleware.php';
require_once 'app/middleware/GuestMiddleware.php';
require_once 'app/middleware/MentorMiddleware.php';


//controller
use App\Controllers\CategoryController;
use App\Controllers\UserController;
use App\Controllers\AdminController;
use App\Controllers\AuthController;
use App\Controllers\CourseController;
use App\Controllers\ModuleController;
use App\Controllers\QuizController;
use App\Controllers\AnswerController;
use App\Controllers\CoursesController;
use App\Controllers\ForumController;
use App\Controllers\MentorController;
use App\Controllers\ProfileController;
//middleware
use App\Middleware\AuthMiddleware;
use App\Middleware\AdminMiddleware;
use App\Middleware\GuestMiddleware;
use App\Middleware\MentorMiddleware;



$router = new Router();

$router->get('/', [UserController::class, 'index'], [new AuthMiddleware]);

//auth
$router->get('/login', [AuthController::class, 'loginView'], [new GuestMiddleware]);
$router->post('/login', [AuthController::class, 'login'], [new GuestMiddleware]);
$router->get('/register', [AuthController::class, 'registerView'], [new GuestMiddleware]);
$router->post('/register', [AuthController::class, 'register'], [new GuestMiddleware]);
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
$router->post('/admin/course/delete', [CourseController::class, 'deleteCourse'], [new AuthMiddleware, new AdminMiddleware]);
$router->get('/admin/course/{id}', [CourseController::class, 'courseEditView'], [new AuthMiddleware, new AdminMiddleware]);
$router->post('/admin/course/{id}', [CourseController::class, 'editCourse'], [new AuthMiddleware, new AdminMiddleware]);

//admin-module
$router->get('/admin/course/{id}/module', [ModuleController::class, 'index'], [new AuthMiddleware, new AdminMiddleware]);
$router->post('/admin/course/{id}/module', [ModuleController::class, 'addNewModule'], [new AuthMiddleware, new AdminMiddleware]);
$router->post('/admin/course/{id}/module/delete', [ModuleController::class, 'deleteModules'], [new AuthMiddleware, new AdminMiddleware]);
$router->post('/admin/course/{id}/module/edit', [ModuleController::class, 'editModule'], [new AuthMiddleware, new AdminMiddleware]);

//admin-quiz
$router->get('/admin/course/{id}/module/{module}/quiz', [QuizController::class, 'index'], [new AuthMiddleware, new AdminMiddleware]);
$router->post('/admin/course/{id}/module/{module}/quiz', [QuizController::class, 'addQuiz'], [new AuthMiddleware, new AdminMiddleware]);
$router->post('/admin/course/{id}/module/{module}/quiz/edit', [QuizController::class, 'editQuiz'], [new AuthMiddleware, new AdminMiddleware]);
$router->get('/admin/course/{id}/module/{module}/quiz/delete', [QuizController::class, 'deleteQuiz'], [new AuthMiddleware, new AdminMiddleware]);

//admin-answer
$router->post('/admin/course/{id}/module/{module}/quiz/answer', [AnswerController::class, 'addAnswer'], [new AuthMiddleware, new AdminMiddleware]);
$router->post('/admin/course/{id}/module/{module}/quiz/answer/edit', [AnswerController::class, 'editAnswer'], [new AuthMiddleware, new AdminMiddleware]);
$router->get('/admin/course/{id}/module/{module}/quiz/answer/delete', [AnswerController::class, 'deleteAnswer'], [new AuthMiddleware, new AdminMiddleware]);

//user->courses
$router->get('/courses', [CoursesController::class, 'index'], [new AuthMiddleware]);
$router->get('/course/{id}', [CoursesController::class, 'courseDetail'], [new AuthMiddleware]);
//user->buy-course
$router->post('/course/{id}', [CoursesController::class, 'buyCourse'], [new AuthMiddleware]);
//user->my-courses
$router->get('/my/courses', [CoursesController::class, 'myCourse'], [new AuthMiddleware]);
$router->get('/my/course/{id}', [CoursesController::class, 'myCourseDetail'], [new AuthMiddleware]);
$router->post('/my/course/{id}/project', [CoursesController::class, 'submitProject'], [new AuthMiddleware]);
//user->submitQuiz
$router->post('/my/course/{id}/quiz', [CoursesController::class, 'submitQuiz'], [new AuthMiddleware]);

//forum
$router->get('/course/{id}/forum', [ForumController::class, 'courseForum'], [new AuthMiddleware]);
$router->get('/course/{id}/forum/{forum}', [ForumController::class, 'detailForum'], [new AuthMiddleware]);
$router->post('/course/{id}/forum/{forum}', [ForumController::class, 'addComment'], [new AuthMiddleware]);
$router->post('/forum/post', [ForumController::class, 'addPost'], [new AuthMiddleware]);
$router->post('/course/{id}/forum/{forum}/edit', [ForumController::class, 'editPost'], [new AuthMiddleware]);
$router->get('/course/{id}/forum/{forum}/delete', [ForumController::class, 'deletePost'], [new AuthMiddleware]);
$router->get('/forum', [MentorController::class, 'listForum'], [new AuthMiddleware]);


//mentor
$router->get('/mentor/dashboard', [MentorController::class, 'index'], [new AuthMiddleware, new MentorMiddleware]);
$router->post('/mentor/dashboard', [MentorController::class, 'updateStatusCourse'], [new AuthMiddleware, new MentorMiddleware]);

$router->get('/profile', [ProfileController::class, 'index'], [new AuthMiddleware]);
$router->post('/profile', [ProfileController::class, 'editProfile'], [new AuthMiddleware]);
$router->post('/profile/password', [ProfileController::class, 'changePassword'], [new AuthMiddleware]);




$router->run();