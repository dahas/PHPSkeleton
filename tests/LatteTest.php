<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use PHPSkeleton\Library\Latte;
use PHPSkeleton\Sources\Response;

!defined('ROOT') && define('ROOT', dirname(__DIR__, 1));

$dotenv = Dotenv\Dotenv::createImmutable(ROOT);
$dotenv->safeLoad();

class LatteTest extends TestCase
{
    private Response $response; 
    private Latte $template; 
 
    protected function setUp() : void
    {
        $_ENV['LAYOUT_TEMPLATE_NAME'] = "Layout.html";

        $this->response = new Response();
        $this->template = new Latte($this->response, __DIR__ . '/files', __DIR__ . '/cache');
    }
 
    protected function tearDown() : void
    {
        unset($this->response);
        unset($this->template);
    }
    
    public function testParse()
    {
        $partial = $this->template->parse("Partial.html", [
            "header" => "John Rambo",
            "var" => "Partial content",
            "list" => [
                "aaa" => "Alpha",
                "bbb" => "Beta",
                "ccc" => "Gamma",
            ]
        ]);
        
        $this->template->assignTo(Latte::LAYOUT, [
            "partial" => $partial
        ]);

        $this->template->render([
            "title" => "John Rambo",
            "text" => "Something escaped",
        ]);

        $html = $this->response->getBody();

        $this->assertStringEqualsFile(__DIR__ . "/files/result.html", $html);
    }
}