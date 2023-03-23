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
        $template = new Latte($this->response);

        $this->router->notFound(function (Request $request, Response $response) use ($template) {
            $response->setStatus(404);
            $content = $template->render('404.partial.html');
            $template->assign([
                'title' => '404 Not Found',
                'content' => $content
            ]);
        });

        $this->router->run();

        $nav = $template->render('Nav.partial.html', [
            "items" => [
                "/" => "Home",
                "/Arithmetic" => "Arithmetic",
                "/None" => "Third item"
            ]
        ]);

        $template->assign([
            "nav" => $nav
        ]);

        $html = $template->render();

        $this->response->write($html);

        $this->response->flush();
    }
}