<?php
namespace App\Middleware;

use MiddlewareInterface;

class AdminMiddleware implements MiddlewareInterface {
    public function handle(array $params): bool {
        session_start();
        if ($_SESSION['user']['role'] == 'admin') {
            header("HTTP/1.0 403 Forbidden");

            return false;
        }

        return true; // Continue if authenticated
    }
}
