<?php

namespace PHPSkeleton\Library;

class Navigation {

    private static array $items = [
        "/" => "Home",
        "/Arithmetic" => "Arithmetic",
        "/Text/reverse?flip=elloH" => "Flip Text",
        "/Data/load" => "Data",
        "/qwert" => "No Controller"
    ];

    public static function items(): array
    {
        return self::$items;
    }
}