<?php declare(strict_types=1);

namespace PHPSkeleton\App;

use PHPSkeleton\Sources\Request;
use PHPSkeleton\Sources\Response;
use PHPSkeleton\Sources\Router;

class AppController {

    private Request $request;
    private Response $response;
    private Router $router;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
    }

    public function execute(): void
    {
        $this->router->notFound(function (Request $request, Response $response) {
            $this->response->setStatus(404);
            $this->response->write("Page Not Found!");
        });

        $this->router->run();

        $this->response->flush();
    }
}