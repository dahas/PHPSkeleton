<?php declare(strict_types=1);

namespace PHPSkeleton\App;

use PHPSkeleton\Sources\AppBase;
use PHPSkeleton\Controller\NotFoundController;

class App extends AppBase {

    public function execute(): void
    {
        $this->router->notFound([new NotFoundController, "main"]);
        $this->router->run();

        $this->response->flush();
    }
}