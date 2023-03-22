<?php declare(strict_types=1);

namespace PHPSkeleton\App;

use PHPSkeleton\Sources\attributes\Route;
use PHPSkeleton\Sources\ControllerBase;
use PHPSkeleton\Sources\Request;
use PHPSkeleton\Sources\Response;

class IndexController extends ControllerBase {

    #[Route(path: '/', method: 'get')]
    public function main(Request $request, Response $response): void
    {
        $data = $request->getData();

        $_nav = [
            "items" => [
                "one" => "First menu item",
                "two" => "Second menu item",
                "dri" => "Third menu item"
            ]
        ];
        $response->assign("nav", "Nav.html", $_nav);

        $_content = [
            "var" => "Hello Latte!"
        ];
        $response->assign("content", 'Index.html', $_content);
    }
}