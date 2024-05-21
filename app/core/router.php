<?php

class Router {

    private array $handlers = [];
    private $notFoundHandler;
    private const METHOD_POST = 'POST';
    private const METHOD_GET = 'GET';

    public function get(string $path, $handler, array $middlewares = []) : void 
    {
        $this->addHandler(self::METHOD_GET, $path, $handler, $middlewares);
    }

    public function post(string $path, $handler, array $middlewares = []) : void 
    {
        $this->addHandler(self::METHOD_POST, $path, $handler, $middlewares);
    }

    public function notFoundHandler($handler) : void
    {
        $this->notFoundHandler = $handler;
    }

    private function addHandler(string $method, string $path, $handler, array $middlewares) : void 
    {
        $this->handlers[] = [
            'path' => $path,
            'method' => $method,
            'handler' => $handler,
            'middlewares' => $middlewares
        ];
    }

    public function run() {
        $requestUri = parse_url($_SERVER['REQUEST_URI']);
        $requestPath = $requestUri['path'];
        $requestPath = substr($requestPath, 13); // Adjust as necessary for your base path
        $method = $_SERVER['REQUEST_METHOD'];

        $callback = null;
        $params = [];
        $middlewares = [];

        foreach ($this->handlers as $handler) {
            if ($method === $handler['method'] && $this->match($handler['path'], $requestPath, $params)) {
                $callback = $handler['handler'];
                $middlewares = $handler['middlewares'];
                break;
            }
        }

        if (is_array($callback)) {
            $callback[0] = new $callback[0];
        }

        if (!$callback) {
            if (empty($this->notFoundHandler)) {
                header("HTTP/1.0 404 Not Found");
                return;
            }
            $callback = $this->notFoundHandler;
        }

        // Run middlewares specific to this route
        foreach ($middlewares as $middleware) {
            if (!$middleware->handle($params)) {
                return; // Stop execution if middleware returns false
            }
        }

        call_user_func_array($callback, [$params]);
    }

    private function match($route, $path, &$params) {
        $route = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[a-zA-Z0-9_-]+)', $route);
        $route = '#^' . $route . '$#';

        if (preg_match($route, $path, $matches)) {
            foreach ($matches as $key => $match) {
                if (is_string($key)) {
                    $params[$key] = $match;
                }
            }
            return true;
        }
        return false;
    }
}
