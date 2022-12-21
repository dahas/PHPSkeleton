<?php declare(strict_types=1);

namespace PHPSkeleton\Sources;

class Router {

    private array $handlers;
    private $notFoundHandler;

    private const GET = "GET";
    private const POST = "POST";

    public function get(string $path, callable|array $callback): void
    {
        $this->addHandlers(self::GET, $path, $callback);
    }

    public function post(string $path, callable|array $callback): void
    {
        $this->addHandlers(self::POST, $path, $callback);
    }

    private function addHandlers(string $method, string $path, callable|array $callback): void
    {
        $this->handlers[$method . $path] = [
            "method" => $method,
            "path" => $path,
            "callback" => $callback
        ];
    }

    public function notFound(callable $callback): void
    {
        $this->notFoundHandler = $callback;
    }

    public function run(): void
    {
        $path = parse_url($_SERVER['REQUEST_URI'])['path'];
        $method = $_SERVER['REQUEST_METHOD'];

        if (isset($this->handlers[$method . $path])) {
            $handler = $this->handlers[$method . $path];

            if (is_array($handler["callback"]) && sizeof($handler["callback"]) == 2) {
                $callback = [new $handler["callback"][0], $handler["callback"][1]];
            } else if (is_array($handler["callback"]) && sizeof($handler["callback"]) != 2) {
                $callback = null;
            } else {
                $callback = $handler["callback"];
            }

            if ($callback) {
                call_user_func_array($callback, [
                    array_merge($_GET, $_POST)
                ]);
            }
        } else {
            if ($this->notFoundHandler) {
                call_user_func($this->notFoundHandler);
            } else {
                header("HTTP/1.0 404 Page not found!");
            }
        }
    }
}