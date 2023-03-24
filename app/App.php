<?php declare(strict_types=1);

namespace PHPSkeleton\App;

use PHPSkeleton\Library\Latte;
use PHPSkeleton\Sources\AppBase;
use PHPSkeleton\Sources\Request;
use PHPSkeleton\Sources\Response;

class App extends AppBase {

    public function __construct()
    {
        parent::__construct();
    }

    public function execute(): void
    {
        $template = new Latte($this->response);

        $this->router->notFound(function (Request $request, Response $response) use ($template) {
            $response->setStatus(404);
            $template->assignTo(Latte::LAYOUT, [
                'title' => '404 Not Found',
                'content' => $template->parse('404.partial.html')
            ]);
        });

        $this->router->run();

        $nav = $template->parse('Nav.partial.html', [
            "items" => [
                "/" => "Home",
                "/Arithmetic" => "Arithmetic",
                "/Text/reverse?flip=elloH" => "Flip Text"
            ]
        ]);

        $template->assignTo(Latte::LAYOUT, [
            "nav" => $nav
        ]);

        $template->render();

        $this->response->flush();
    }
}