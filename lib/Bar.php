<?php declare(strict_types=1);

namespace App;

use Sources\BarIF;

class Bar implements BarIF
{
    private static ?Bar $instance = null;

    private function __construct()
    {
    }

    public static function getInstance(): Bar
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function compare(string|int $a, string|int $b) : bool
    {
        return $a === $b;
    }

	/**
	 * @param mixed $name
	 * @param mixed $var
	 * @return mixed
	 */
	public function setVariable($name, $var) {
	}
	
	/**
	 *
	 * @param mixed $template
	 * @return mixed
	 */
	public function getHtml($template) {
	}
}
