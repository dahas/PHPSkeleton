<?php declare(strict_types=1);

namespace PHPSkeleton\Controller;

use PHPSkeleton\Library\Latte;
use PHPSkeleton\Sources\attributes\Route;
use PHPSkeleton\Sources\ControllerBase;
use PHPSkeleton\Sources\JsonAdapter;
use PHPSkeleton\Sources\Request;
use PHPSkeleton\Sources\Response;

class TextController extends ControllerBase {

    #[Route(path: '/Text/bold', method: 'get')]
    public function bold(Request $request, Response $response): void
    {
        $data = $request->getData();

        $template = new Latte();

        $_vars = [
            'navigation' => 'NAVIGATION',
            'title' => 'Text Controller',
            'header' => 'Text',
            "var" => "Hello Text Controller!"
        ];
        $html = $template->parse('Text.partial.html', $_vars);
        
        $response->addHeader("Content-Type", "text/html");
        $response->write($html);
    }

    #[Route(path: '/Text/reverse', method: 'get')]
    public function reverse(Request $request, Response $response): void
    {
        $data = $request->getData();

        $adapter = new JsonAdapter();
        $adapter->setMessage("Success");

        $adapter->setData([
            "rev1" => [
                "Flip {$data['flip']} => " . strrev($data['flip'] ?? ""),
                "Flop {$data['flop']} => " . strrev($data['flop'] ?? "Flop")
            ]
        ]);

        $adapter->setData([
            "rev2" => [
                "Flip {$data['flip']} => " . strrev($data['flip'] ?? ""),
                "Flop {$data['flop']} => " . strrev($data['flop'] ?? "Flop")
            ]
        ]);

        $json = $adapter->encode();

        $response->addHeader("Content-Type", "application/json");
        $response->write($json);
    }
}