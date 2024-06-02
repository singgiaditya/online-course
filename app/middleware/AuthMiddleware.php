<?php
namespace App\Middleware;

use MiddlewareInterface;

class AuthMiddleware implements MiddlewareInterface {
    public function handle(array $params): bool {
        session_start();
        if (!isset($_SESSION['user'])) {
            header("Location:/onlineCourse/login");

            return false;
        }

        return true; // Continue if authenticated
    }
}
