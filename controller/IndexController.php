<?php declare(strict_types=1);

namespace PHPSkeleton\App;

use Latte\Engine;
use PHPSkeleton\Sources\attributes\Route;
use PHPSkeleton\Sources\ControllerBase;
use PHPSkeleton\Sources\Request;
use PHPSkeleton\Sources\Response;

class IndexController extends ControllerBase {

    #[Route(path: '/', method: 'get')]
    public function main(Request $request, Response $response): void
    {
        $data = $request->getData();
        
        $latte = new Engine();
        $latte->setTempDirectory(ROOT . '/.latte/cache');
        if ($_ENV['MODE'] !== 'dev') {
            $latte->setAutoRefresh(false);
        }

        $params = [
            "var" => "Hello Latte!",
            "items" => [
                "one" => "First menu item",
                "two" => "Second menu item",
                "dri" => "Third menu item"
            ],
            "extra" => $latte->renderToString(ROOT . '/templates/Extra.html')
        ];
        
        $output = $latte->renderToString(ROOT . '/templates/Index.html', $params);

        $response->write($output);
    }
}