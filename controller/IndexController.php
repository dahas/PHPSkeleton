<?php declare(strict_types=1);

namespace PHPSkeleton\App;

use PHPSkeleton\Sources\attributes\Route;
use PHPSkeleton\Sources\ControllerBase;
use PHPSkeleton\Sources\Latte;
use PHPSkeleton\Sources\Request;
use PHPSkeleton\Sources\Response;

class IndexController extends ControllerBase {

    #[Route(path: '/', method: 'get')]
    public function main(Request $request, Response $response): void
    {
        $data = $request->getData();

        $template = new Latte();

        $_nav = [
            "items" => [
                "one" => "Home",
                "two" => "Second",
                "dri" => "Third item"
            ]
        ];
        $nav = $template->parse("Nav.partial.html", $_nav);

        $_content = [
            "title" => "PHP App Skeleton",
            "var" => "Hello Latte!",
            "nav" => $nav
        ];
        $content = $template->parse('Index.partial.html', $_content);

        $response->write($content);
    }
}