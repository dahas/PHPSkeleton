<?php declare(strict_types=1);

namespace PHPSkeleton\App;

use PHPSkeleton\Sources\interfaces\Bars;

class Bar implements Bars {  // <-- Implementing the interface
    private static ? Bar $instance = null;


    private function __construct()  // <-- The constructor of a singleton class must be at least protected
    {
    }


    public static function getInstance() : Bar  // <-- Create an instance if none yet existing
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }


    public function compare(string|int $a, string|int $b): bool
    {
        return $a === $b;
    }


    public function setVariable($name, $var)  // <-- Implentation required from interface
    {
    }


    public function getHtml($template)  // <-- Implentation required from interface
    {
    }
}