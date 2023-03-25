<?php declare(strict_types=1);

namespace PHPSkeleton\App;

use PHPSkeleton\Library\Latte;
use PHPSkeleton\Sources\AppBase;
use PHPSkeleton\Sources\HtmlAdapter;
use PHPSkeleton\Sources\JsonAdapter;
use PHPSkeleton\Sources\Request;
use PHPSkeleton\Sources\Response;

class App extends AppBase {

    public function __construct()
    {
        parent::__construct();
    }

    public function execute(): void
    {
        $this->router->notFound(function (Request $request, Response $response) {
            $response->setStatus(404);
            $adapter = new JsonAdapter();
            $adapter->setMessage("Error! The requested resource doesn't exist!");
            $json = $adapter->encode();

            $response->addHeader("Content-Type", "application/json");
            $response->write($json);
        });

        $this->router->run();

        // $htmlAdapter = new HtmlAdapter($this->response);

        // $template = new Latte($htmlAdapter);

        // $nav = $template->parse('Nav.partial.html', [
        //     "items" => [
        //         "/" => "Home",
        //         "/Arithmetic" => "Arithmetic",
        //         "/Text/reverse?flip=elloH" => "Flip Text",
        //         "/qwert" => "No Controller"
        //     ]
        // ]);

        // $template->assignTo(Latte::LAYOUT, [
        //     "nav" => $nav
        // ]);

        // $template->render();

        $this->response->flush();
    }
}