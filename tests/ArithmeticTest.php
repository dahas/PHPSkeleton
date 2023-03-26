<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use PHPSkeleton\Sources\Response;
use PHPSkeleton\Sources\Request;
use PHPSkeleton\Controller\ArithmeticController;

class ArithmeticTest extends TestCase {
    
    private ArithmeticController $arithmetic;
    private Request $request;
    private Response $response;

    protected function setUp(): void
    {
        $this->arithmetic = new ArithmeticController();
        $this->request = new Request();
        $this->response = new Response();
    }

    protected function tearDown(): void
    {
        unset($this->arithmetic);
        unset($this->request);
        unset($this->response);
    }

    public function testAdd()
    {
        $this->request->setData([
            "a" => 3,
            "b" => 5
        ]);
        $this->arithmetic->add($this->request, $this->response);
        $this->assertEquals('{"message":"Success","data":{"Addition":"3 + 5 = 8,00"},"count":1}', $this->response->read());
    }
}