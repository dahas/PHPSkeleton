<?php declare(strict_types=1);

namespace PHPSkeleton\Controller;

use PHPSkeleton\Library\JsonAdapter;
use PHPSkeleton\Sources\attributes\Route;
use PHPSkeleton\Sources\attributes\Inject;
use PHPSkeleton\Sources\Request;
use PHPSkeleton\Sources\Response;


class DataController extends AppController
{
    #[Inject('DataService')]
    protected $DataService;

    #[Inject('UserService')] 
    protected $UserService;

    #[Route(path: '/Data/load', method: 'get')]
    public function load(Request $request, Response $response) : void
    {
        $svcs = [
            'DataService' => $this->DataService->loadData(),
            'UserService' => $this->UserService->loadData()
        ];

        $adapter = new JsonAdapter();
        $adapter->setMessage("Success");
        $adapter->setData($svcs);
        $json = $adapter->encode();
        $response->write($json);
    }
}
