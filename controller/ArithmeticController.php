<?php declare(strict_types=1);

namespace PHPSkeleton\App;

use PHPSkeleton\Sources\attributes\Route;
use PHPSkeleton\Sources\Request;
use PHPSkeleton\Sources\Response;
use PHPSkeleton\Sources\traits\Utils;


class ArithmeticController
{
    use Utils;  // <-- Use methods of a trait


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
