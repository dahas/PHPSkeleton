<?php declare(strict_types=1);

namespace PHPSkeleton\App;

use PHPSkeleton\Sources\attributes\Route;
use PHPSkeleton\Sources\Request;
use PHPSkeleton\Sources\Response;

class TextController {

    #[Route(path: '/Text/reverse', method: 'get')]
    public function reverse(Request $request, Response $response): void
    {
        $data = $request->getData();
        $response->write("Flip {$data['flip']} => " . strrev($data['flip']));
    }
}