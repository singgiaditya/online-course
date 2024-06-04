<?php
namespace App\Middleware;

use MiddlewareInterface;

class GuestMiddleware implements MiddlewareInterface {
    public function handle(array $params): bool {
        session_start();
        if (isset($_SESSION['user'])) {
            if($_SESSION['user']['role'] == 'admin'){
            header("Location:/onlineCourse/admin/dashboard");
            return false;
            }
            header("Location:/onlineCourse/");

            return false;
        }

        return true; // Continue if authenticated
    }
}
