<?php declare(strict_types=1);

namespace PHPSkeleton\Controller;

use PHPSkeleton\Library\Latte;
use PHPSkeleton\Sources\attributes\Route;
use PHPSkeleton\Sources\Request;
use PHPSkeleton\Sources\Response;

class TextController {

    #[Route(path: '/Text/bold', method: 'get')]
    public function bold(Request $request, Response $response): void
    {
        $data = $request->getData();

        $response->addHeader("XHR", true);

        $response->html->write('<b>Hello</b>');
    }

    #[Route(path: '/Text/reverse', method: 'get')]
    public function reverse(Request $request, Response $response): void
    {
        $data = $request->getData();

        $response->json->assignData([
            "rev1" => [
                "Flip {$data['flip']} => " . strrev($data['flip'] ?? ""),
                "Flop {$data['flop']} => " . strrev($data['flop'] ?? "Flop")
            ]
        ]);

        $response->json->assignData([
            "rev2" => [
                "Flip {$data['flip']} => " . strrev($data['flip'] ?? ""),
                "Flop {$data['flop']} => " . strrev($data['flop'] ?? "Flop")
            ]
        ]);
    }
} 