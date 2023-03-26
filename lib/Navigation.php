<?php

namespace PHPSkeleton\Library;

class Navigation {

    private array $items = [
        "/" => "Home",
        "/Arithmetic" => "Arithmetic",
        "/Text/reverse?flip=elloH" => "Flip Text",
        "/Data/load" => "Data",
        "/qwert" => "No Controller"
    ];

    public function setItems(array $items): void
    {
        $this->items = $items;
    }

    public function getItems(): array
    {
        return $this->items;
    }
}