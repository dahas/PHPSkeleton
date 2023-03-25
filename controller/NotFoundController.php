<?php declare(strict_types=1);

namespace PHPSkeleton\Controller;

use PHPSkeleton\Library\Latte;
use PHPSkeleton\Sources\Request;
use PHPSkeleton\Sources\Response;

class NotFoundController {

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
            'title' => 'Error 404 - Page Not Found'
        ];
        $html = $template->parse('404.partial.html', $_vars);
        
        $response->addHeader("Content-Type", "text/html");
        $response->write($html);
    }
}