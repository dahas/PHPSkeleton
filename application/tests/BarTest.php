<?php declare(strict_types=1);

use PHPSkeleton\App\Bar;
use PHPUnit\Framework\TestCase;

class BarTest extends TestCase
{
    private $bar; 
 
    protected function setUp() : void
    {
        $this->bar = Bar::getInstance();
    }
 
    protected function tearDown() : void
    {
        $this->bar = NULL;
    }

    public function compareData() {
        return array(
            array("Vergleich", "vergleich", false),
            array("vergleich", "vergleIch", false),
            array("123", 123, false),
            array("123", "123", true)
        );
    }
 
    /**
     * @dataProvider compareData
     */
    public function testCompare($a, $b, $expected)
    {
        $result = $this->bar->compare($a, $b);
        $this->assertEquals($result, $expected);
    }
}