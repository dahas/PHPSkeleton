<?php declare(strict_types=1);

use PHPSkeleton\App\ArithmeticController;
use PHPUnit\Framework\TestCase;
use PHPSkeleton\Sources\Response;
use PHPSkeleton\Sources\Request;

class ArithmeticTest extends TestCase {
    private $arithmetic;
    private $request;
    private $response;

    protected function setUp(): void
    {
        $this->arithmetic = new ArithmeticController();
        $this->request = new Request();
        $this->response = new Response();
    }

    protected function tearDown(): void
    {
        $this->arithmetic = NULL;
        $this->request = NULL;
        $this->response = NULL;
    }

    public function testAdd()
    {
        $this->request->setData([
            "a" => 3,
            "b" => 5
        ]);
        $this->arithmetic->add($this->request, $this->response);
        $this->assertEquals('Addition: 3 + 5 = 8,00', $this->response->getBody());
    }
}