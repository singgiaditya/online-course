<?php

class UserMiddleware implements MiddlewareInterface {
    public function handle(array $params): bool {
        if (!isset($_SESSION['user'])) {
            header("HTTP/1.0 403 Forbidden");
            echo "Forbidden";
            return false; // Stop execution if not authenticated
        }

        if ($_SESSION['user']['role'] == 'user') {
            header("HTTP/1.0 403 Forbidden");
            echo "Forbidden";
            return false; // Stop execution if not authenticated
        }

        return true; // Continue if authenticated
    }
}
