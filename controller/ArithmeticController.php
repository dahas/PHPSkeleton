<?php declare(strict_types=1);

namespace PHPSkeleton\Controller;

use PHPSkeleton\Sources\attributes\Route;
use PHPSkeleton\Library\JsonAdapter;
use PHPSkeleton\Sources\Request;
use PHPSkeleton\Sources\Response;
use PHPSkeleton\Sources\traits\Utils;


class ArithmeticController extends AppController {
    
    use Utils;

    #[Route(path: '/Arithmetic', method: 'get')]
    public function main(Request $request, Response $response): void
    {
        $this->template->assign([
            'title' => 'Arithmetic Controller',
            'header' => 'Arithmetic',
            "var" => "Hello Arithmetic Controller!"
        ]);
        $this->template->parse('Arithmetic.partial.html');
        $this->template->render($request, $response);
    }


    #[Route(path: '/Arithmetic/add', method: 'get')]
    public function add(Request $request, Response $response): void
    {
        $data = $request->getData();
        $res = $this->germanDecimalNumberFormat($data["a"] + $data["b"]); // <-- Method from the trait
        $adapter = new JsonAdapter();
        $adapter->setMessage("Success");
        $adapter->setData(["Addition" => sprintf("%s + %s = %s", $data["a"], $data["b"], $res)]);
        $adapter->encode($request, $response);
    }


    #[Route(path: '/Arithmetic/subtract', method: 'get')]
    public function subtract(Request $request, Response $response): void
    {
        $data = $request->getData();
        $res = $this->germanDecimalNumberFormat($data["a"] - $data["b"]); // <-- Method from the trait
        $adapter = new JsonAdapter();
        $adapter->setMessage("Success");
        $adapter->setData(["Subtraction" => sprintf("%s - %s = %s", $data["a"], $data["b"], $res)]);
        $adapter->encode($request, $response);
    }


    #[Route(path: '/Arithmetic/multiply', method: 'get')]
    public function multiply(Request $request, Response $response): void
    {
        $data = $request->getData();
        $res = $this->germanDecimalNumberFormat($data["a"] * $data["b"]); // <-- Method from the trait
        $adapter = new JsonAdapter();
        $adapter->setMessage("Success");
        $adapter->setData(["Multiplication" => sprintf("%s * %s = %s", $data["a"], $data["b"], $res)]);
        $adapter->encode($request, $response);
    }
}