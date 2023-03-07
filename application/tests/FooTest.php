<?php declare(strict_types=1);

use PHPSkeleton\App\Foo;
use PHPUnit\Framework\TestCase;

class FooTest extends TestCase
{
    private $foo;
 
    protected function setUp() : void
    {
        $this->foo = new Foo();
    }
 
    protected function tearDown() : void
    {
        $this->foo = NULL;
    }
 
    public function testAdd()
    {
        $result = $this->foo->add(3, 5);
        $this->assertEquals('8,00', $result);
    }
}