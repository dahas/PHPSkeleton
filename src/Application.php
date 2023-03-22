<?php declare(strict_types=1);

namespace PHPSkeleton\Sources;

class Application {

    private Request $request;
    private Response $response;
    private Router $router;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response(new Latte());
        $this->router = new Router($this->request, $this->response);
    }

    public function execute(): void
    {
        $this->router->notFound(function (Request $request, Response $response) {
            $response->setStatus(404);
            $response->write("Page Not Found!");
        });

        $this->router->run();

        $this->response->render('App.html', ["title" => "Hey there!"]);
        $this->response->flush();
    }
}