<?php

class Router {

    private array $handlers = [];
    private $notFoundHandler;
    private const METHOD_POST = 'POST';
    private const METHOD_GET = 'GET';

    public function get(string $path, $handler) : void 
    {
        $this->addHandler(self::METHOD_GET, $path, $handler);
    }

    public function post(string $path, $handler) : void 
    {
        $this->addHandler(self::METHOD_POST, $path, $handler);
    }

    public function notFoundHandler($handler) : void
    {
        $this->notFoundHandler = $handler;
    }

    private function addHandler(string $method, string $path, $handler) : void 
    {
        $this->handlers[] = [
            'path' => $path,
            'method' => $method,
            'handler' => $handler
        ];
    }

    public function run() {
        $requestUri = parse_url($_SERVER['REQUEST_URI']);
        $requestPath = $requestUri['path'];
        $requestPath = substr($requestPath, 13);
        $method = $_SERVER['REQUEST_METHOD'];

        $callback = null;
        $params = [];

        foreach ($this->handlers as $handler) {
            if ($method === $handler['method'] && $this->match($handler['path'], $requestPath, $params)) {
                $callback = $handler['handler'];
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
