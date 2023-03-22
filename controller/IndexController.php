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
                "one" => "First menu item",
                "two" => "Second menu item",
                "dri" => "Third menu item"
            ]
        ];
        $nav = $template->parse("Nav.partial.html", $_nav);

        $_content = [
            "title" => "Hey there!",
            "var" => "Hello Latte!",
            "nav" => $nav,
            "content" => '<b>The Index content ...</b>'
        ];
        $content = $template->parse('Index.partial.html', $_content);

        $response->write($content);
    }
}