<?php declare(strict_types=1);

namespace PHPSkeleton\Controller;

use PHPSkeleton\Library\Latte;
use PHPSkeleton\Sources\attributes\Route;
use PHPSkeleton\Sources\Request;
use PHPSkeleton\Sources\Response;
use PHPSkeleton\Sources\traits\Utils;


class ArithmeticController
{
    use Utils;  // <-- Use methods of a trait


    #[Route(path: '/Arithmetic', method: 'get')]
    public function main(Request $request, Response $response): void
    {
        $data = $request->getData();

        $template = new Latte($response);

        $_vars = [
            'header' => 'Arithmetic',
            "var" => "Hello Arithmetic Controller!"
        ];
        $content = $template->parse('Arithmetic.partial.html', $_vars);
        $template->assignTo(Latte::LAYOUT, [
            'title' => 'Arithmetic',
            'content' => $content
        ]);
    }


    #[Route(path: '/Arithmetic/add', method: 'get')]
    public function add(Request $request, Response $response): void
    {
        $data = $request->getData();
        $res = $this->germanDecimalNumberFormat($data["a"] + $data["b"]);  // <-- Method from the trait
        $response->write(sprintf("Addition: %s + %s = %s", $data["a"], $data["b"], $res));
    }


    #[Route(path: '/Arithmetic/subtract', method: 'get')]
    public function subtract(Request $request, Response $response): void
    {
        $data = $request->getData();
        $res = $this->germanDecimalNumberFormat($data["a"] - $data["b"]);  // <-- Method from the trait
        $response->write(sprintf("Subtraction: %s - %s = %s", $data["a"], $data["b"], $res));
    }


    #[Route(path: '/Arithmetic/multiply', method: 'get')]
    public function multiply(Request $request, Response $response): void
    {
        $data = $request->getData();
        $res = $this->germanDecimalNumberFormat($data["a"] * $data["b"]);  // <-- Method from the trait
        $response->write(sprintf("Multiplication: %s * %s = %s", $data["a"], $data["b"], $res));
    }
}
