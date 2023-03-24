<?php declare(strict_types=1);

namespace PHPSkeleton\Controller;

use PHPSkeleton\Sources\attributes\Route;
use PHPSkeleton\Sources\ControllerBase;
use PHPSkeleton\Sources\attributes\Inject;


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
    public function loadServices() : array
    {
        $svcs = [];
        $svcs[] = $this->DataService->loadData();   // <-- Method from the injected service
        $svcs[] = $this->UserService->loadData();

        print_r($svcs);
        
        return $svcs;
    }
}
