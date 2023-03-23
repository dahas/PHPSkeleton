<?php declare(strict_types=1);

namespace PHPSkeleton\App;

use PHPSkeleton\Library\Latte;
use PHPSkeleton\Sources\attributes\Route;
use PHPSkeleton\Sources\ControllerBase;
use PHPSkeleton\Sources\Request;
use PHPSkeleton\Sources\Response;

class IndexController extends ControllerBase {

    #[Route(path: '/', method: 'get')]
    public function main(Request $request, Response $response): void
    {
        $data = $request->getData();

        $template = new Latte($response);

        $_vars = [
            "var" => "Hello Index Controller!"
        ];
        $template->parse('Index.partial.html', 'content', $_vars);
    }
}