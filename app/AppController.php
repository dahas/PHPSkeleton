<?php declare(strict_types=1);

namespace PHPSkeleton\App;

use PHPSkeleton\Library\Latte;
use PHPSkeleton\Sources\AppBase;
use PHPSkeleton\Sources\Request;
use PHPSkeleton\Sources\Response;

class AppController extends AppBase {

    public function __construct()
    {
        parent::__construct();
    }

    public function execute(): void
    {
        $this->router->notFound(function (Request $request, Response $response) {
            $response->setStatus(404);
            $response->write("Page Not Found!");
        });

        $this->router->run();

        $template = new Latte($this->response);

        $template->parse('Nav.partial.html', 'nav', [
            "items" => [
                "one" => "Home",
                "two" => "Second",
                "dri" => "Third item"
            ]
        ]);

        $_vars = [
            "title" => "PHP App Skeleton"
        ];
        $template->render('App.html', $_vars);

        $this->response->flush();
    }
}