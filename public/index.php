<?php

require dirname(__DIR__, 1) . '/application/vendor/autoload.php';

use PHPSkeleton\App\Bar;  // <-- Import of class
use PHPSkeleton\App\Foo;

$bar = Bar::getInstance();  // <-- Creating a singleton
$foo = new Foo();

foreach($foo->loadServices() as $service) {
    echo $service;
}

echo $foo->add(1250, 750.50); 