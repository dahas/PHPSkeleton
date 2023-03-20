<?php declare(strict_types=1);

namespace PHPSkeleton\App;

use PHPSkeleton\Sources\attributes\Route;

class TextController {
    
    #[Route('/Text/reverse')]
    public function reverse($data): void
    {
        echo "Flip {$data['flip']} => " . strrev($data['flip']);
    }
}