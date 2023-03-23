<?php declare(strict_types=1);

namespace PHPSkeleton\Sources;

abstract class AppBase {

    protected Request $request;
    protected Response $response;
    protected Router $router;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
    }

    protected abstract function execute(): void;
}