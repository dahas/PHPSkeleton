<?php

require dirname(__DIR__, 1) . '/vendor/autoload.php'; // <-- Import of autoloader

// Import of classes
use PHPSkeleton\App\Bar;
use PHPSkeleton\App\Foo;
use PHPSkeleton\Sources\Router;
use PHPSkeleton\App\ContactForm;

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__, 1));
$dotenv->safeLoad();


$router = new Router();

/**
 * http://localhost:2400/
 */
$router->get("/", function () {
    echo "Welcome Home!";
});

/**
 * http://localhost:2400/foo
 */
$router->get("/foo", function () {
    $foo = new Foo();
    foreach ($foo->loadServices() as $service) {
        echo $service;
    }
});

/**
 * http://localhost:2400/bar/compare?a=Halli&b=Hallo
 */
$router->get("/bar/compare", function (array $params) {
    $bar = Bar::getInstance(); // <-- Creating a singleton
    if (!empty($params)) {
        if ($bar->compare($params["a"], $params["b"])) {
            echo "<span style='color:green;'>A und B sind identisch!</span>";
        } else {
            echo "<span style='color:red;'>A und B sind NICHT identisch!</span>";
        }
    }
});

/**
 * http://localhost:2400/contact
 */
$router->get("/contact", [ContactForm::class, "renderForm"]); // <-- Provide a callable in a separate class as an Array: Classname first, then the Method.
$router->post("/contact", function ($params) {
    print_r($params);
});

/**
 * http://localhost:2400/whatsoever
 */
$router->notFound(function () {
    echo "Page Not Found!";
});

$router->get("/filter", function ($params) {
    foreach ($params as $key => $val) {
        if (intval($params[$key]))
            echo "NUMBER: $key => $val \n";
        else {
            echo "STRING: $key => " . htmlspecialchars(string: $val, encoding: "UTF-8") . " \n";
        }
    }
});

$router->run();