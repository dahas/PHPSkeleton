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
        $template = new Latte();

        $_vars = [
            "nav" => [
                "/" => "Home",
                "/Arithmetic" => "Arithmetic",
                "/Text/reverse?flip=elloH" => "Flip Text",
                "/Data/load" => "Data",
                "/qwert" => "No Controller"
            ],
            'title' => 'Index Controller',
            'header' => 'Index',
            "var" => "Hello Index Controller!"
        ];
        $html = $template->parse('Index.partial.html', $_vars);
        
        $response->addHeader("Content-Type", "text/html");
        $response->write($html);
    }
}