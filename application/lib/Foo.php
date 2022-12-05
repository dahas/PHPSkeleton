<?php declare(strict_types=1);

namespace PHPSkeleton\App;

use PHPSkeleton\Sources\ParentClass;
use PHPSkeleton\Sources\attributes\Inject;
use PHPSkeleton\Sources\traits\Tools;


class Foo extends ParentClass
{
    use Tools;  // <-- Enable the usage of methods of the trait


    #[Inject('DataService')]  // <-- Dependency injection with an Attribute
    protected $DataService;


    #[Inject('UserService')]
    protected $UserService;


    public function __construct()
    {
        parent::__construct();
    }


    public function add(int|float $a, int|float $b): string
    {
        return $this->formatNumber($a + $b);  // <-- Method from the trait
    }

    
    public function loadServices() : array
    {
        $svcs = [];
        $svcs[] = $this->DataService->loadData();   // <-- Method from the injected service
        $svcs[] = $this->UserService->loadData();
        return $svcs;
    }
}
