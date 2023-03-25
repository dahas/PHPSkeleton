<?php declare(strict_types=1);

namespace PHPSkeleton\Controller;

use PHPSkeleton\Sources\attributes\Route;
use PHPSkeleton\Sources\ControllerBase;
use PHPSkeleton\Sources\attributes\Inject;
use PHPSkeleton\Sources\Request;
use PHPSkeleton\Sources\Response;


class DataController extends ControllerBase
{
    #[Inject('DataService')]  // <-- Inject dependency
    protected $DataService;


    #[Inject('UserService')]  // <-- Inject dependency
    protected $UserService;


    public function __construct()
    {
        parent::__construct();
    }

    #[Route('/Data/load')]
    public function loadServices(Request $request, Response $response) : array
    {
        $svcs = [];
        $svcs[] = $this->DataService->loadData();   // <-- Method from the injected service
        $svcs[] = $this->UserService->loadData();

        $response->write("<pre>" . serialize($svcs) . "</pre>");
        
        return $svcs;
    }
}
