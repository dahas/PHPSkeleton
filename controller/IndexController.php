<?php declare(strict_types=1);

namespace PHPSkeleton\Controller;

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
            'header' => 'Index',
            "var" => "Hello Index Controller!"
        ];
        $content = $template->parse('Index.partial.html', $_vars);
        $template->assignTo(Latte::LAYOUT, [
            'title' => 'Index',
            'content' => $content
        ]);
    }
}