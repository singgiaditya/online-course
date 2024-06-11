<?php
namespace App\Middleware;

use MiddlewareInterface;

class MentorMiddleware implements MiddlewareInterface {
    public function handle(array $params): bool {
        if ($_SESSION['user']['role'] != 'mentor') {
            header("HTTP/1.0 403 Forbidden");
            return false;
        }

        return true; // Continue if authenticated
    }
}
