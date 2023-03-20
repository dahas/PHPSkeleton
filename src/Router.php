<?php declare(strict_types=1);

namespace PHPSkeleton\Sources;

use PHPSkeleton\Sources\attributes\Route;

class Router {

    private array $handlers;
    private $notFoundHandler;

    private const GET = "get";
    private const POST = "post";

    public function __construct()
    {
        $routesCacheFile = dirname(__DIR__, 1) . "/.routes.cache";
        if (file_exists($routesCacheFile) && $_ENV["MODE"] !== "dev") {
            $routesCache = file($routesCacheFile)[0];
            $this->handlers = unserialize($routesCache);
        } else {
            $handle = fopen($routesCacheFile, "w");

            $files = array_diff(scandir(dirname(__DIR__, 1) . "/controller"), array('.', '..'));

            foreach ($files as $file) {
                $controller = "PHPSkeleton\\App\\" . explode(".", $file)[0];
                $reflectionController = new \ReflectionClass($controller);

                foreach ($reflectionController->getMethods() as $method) {
                    $attributes = $method->getAttributes(Route::class);

                    foreach ($attributes as $attribute) {
                        $route = $attribute->newInstance();

                        $rqMethod = strtolower($route->method);
                        $this->handlers[$rqMethod . $route->path] = [
                            "method" => $rqMethod,
                            "path" => $route->path,
                            "callback" => [$controller, $method->getName()]
                        ];
                    }
                }
            }

            fwrite($handle, serialize($this->handlers));
        }
    }

    public function get(string $path, callable |array $callback): void
    {
        $this->addHandlers(self::GET, $path, $callback);
    }

    public function post(string $path, callable |array $callback): void
    {
        $this->addHandlers(self::POST, $path, $callback);
    }

    private function addHandlers(string $method, string $path, callable |array $callback): void
    {
        $method = strtolower($method);
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
        $method = strtolower($_SERVER['REQUEST_METHOD']);

        if (isset($this->handlers[$method . $path])) {
            $handler = $this->handlers[$method . $path];

            if (is_array($handler["callback"]) && count($handler["callback"]) == 2) {
                $callback = [new $handler["callback"][0], $handler["callback"][1]];
            } else if (is_array($handler["callback"]) && count($handler["callback"]) != 2) {
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