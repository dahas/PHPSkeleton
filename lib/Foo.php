<?php declare(strict_types=1);

namespace App;

use Sources\Tools;

class Foo {

    use Tools;

    public function __construct()
    {
    }

    public function add(int $a, int $b) : int
    {
        $af = $this->filterInput($a);
        $bf = $this->filterInput($b);
        return $af + $bf;
    }
}