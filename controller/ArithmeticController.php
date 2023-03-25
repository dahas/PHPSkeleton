<?php declare(strict_types=1);

namespace PHPSkeleton\Controller;

use PHPSkeleton\Library\Latte;
use PHPSkeleton\Sources\attributes\Route;
use PHPSkeleton\Sources\JsonAdapter;
use PHPSkeleton\Sources\Request;
use PHPSkeleton\Sources\Response;
use PHPSkeleton\Sources\traits\Utils;


class ArithmeticController {
    
    use Utils; // <-- Use methods of a trait

    #[Route(path: '/Arithmetic', method: 'get')]
    public function main(Request $request, Response $response): void
    {
        $template = new Latte();

        $_vars = [
            "nav" => [
                "/" => "Home",
                "/Arithmetic" => "Arithmetic",
                "/Text/reverse?flip=elloH" => "Flip Text",
                "/Data/load" => "Data",
                "/qwert" => "No Controller"
            ],
            'title' => 'Arithmetic Controller',
            'header' => 'Arithmetic',
            "var" => "Hello Arithmetic Controller!"
        ];
        $html = $template->parse('Arithmetic.partial.html', $_vars);
        
        $response->addHeader("Content-Type", "text/html");
        $response->write($html);
    }


    #[Route(path: '/Arithmetic/add', method: 'get')]
    public function add(Request $request, Response $response): void
    {
        $data = $request->getData();
        $res = $this->germanDecimalNumberFormat($data["a"] + $data["b"]); // <-- Method from the trait
        $adapter = new JsonAdapter();
        $adapter->setMessage("Success");
        $adapter->setData(["Addition" => sprintf("%s + %s = %s", $data["a"], $data["b"], $res)]);
        $json = $adapter->encode();
        $response->write($json);
    }


    #[Route(path: '/Arithmetic/subtract', method: 'get')]
    public function subtract(Request $request, Response $response): void
    {
        $data = $request->getData();
        $res = $this->germanDecimalNumberFormat($data["a"] - $data["b"]); // <-- Method from the trait
        $adapter = new JsonAdapter();
        $adapter->setMessage("Success");
        $adapter->setData(["Subtraction" => sprintf("%s - %s = %s", $data["a"], $data["b"], $res)]);
        $json = $adapter->encode();
        $response->write($json);
    }


    #[Route(path: '/Arithmetic/multiply', method: 'get')]
    public function multiply(Request $request, Response $response): void
    {
        $data = $request->getData();
        $res = $this->germanDecimalNumberFormat($data["a"] * $data["b"]); // <-- Method from the trait
        $adapter = new JsonAdapter();
        $adapter->setMessage("Success");
        $adapter->setData(["Multiplication" => sprintf("%s * %s = %s", $data["a"], $data["b"], $res)]);
        $json = $adapter->encode();
        $response->write($json);
    }
}