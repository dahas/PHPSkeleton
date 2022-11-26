<?php declare(strict_types=1);

namespace App;

class Foo {

    public function __construct()
    {
    }

    public function add(int $a, int $b) : int
    {
        return $a + $b;
    }
}