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
$router->get('/admin', [AdminController::class, 'index']);
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