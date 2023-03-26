<?php declare(strict_types=1);

namespace PHPSkeleton\Controller;

use PHPSkeleton\Library\Navigation;
use PHPSkeleton\Library\TemplateEngine;
use PHPSkeleton\Sources\attributes\Route;
use PHPSkeleton\Sources\ControllerBase;
use PHPSkeleton\Sources\Request;
use PHPSkeleton\Sources\Response;

class IndexController extends ControllerBase {

    #[Route(path: '/', method: 'get')]
    public function main(Request $request, Response $response): void
    {
        $template = new TemplateEngine();

        $_vars = [
            "nav" => (new Navigation())->getItems(),
            'title' => 'PHP Skeleton',
            'header' => 'A PHP Application Skeleton',
            "subtitle" => "Use this lightweight framework to quickly build rich web applications. If you are unfamiliar or inexperienced with developing secure and high-performance web applications, I strongly recommend using Symfony, Laravel, or a similar product."
        ];
        $html = $template->parse('Index.partial.html', $_vars);
        
        $response->addHeader("Content-Type", "text/html");
        $response->write($html);
    }
}