<?php

require_once 'router.php';
require_once 'app/controllers/HomeController.php';

use App\Controllers\HomeController;


$router = new Router();
$router->get('/', [HomeController::class, 'index']);

$router->get('/user/{id}', function($params) {
    echo "User ID: " . $params['id'];
});

$router->get('/post/{id}/comment/{commentId}', function($params) {
    echo "Post ID: " . $params['id'] . ", Comment ID: " . $params['commentId'];
});


$router->run();