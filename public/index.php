<?php

require dirname(__DIR__, 1) . '/application/vendor/autoload.php';

use PHPSkeleton\App\Foo;

$foo = new Foo();

echo $foo->add(123, 456); 