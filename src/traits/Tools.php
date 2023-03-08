<?php

namespace PHPSkeleton\Sources\traits;

trait Tools 
{
    public function formatNumber(int|float $input) : string {
        return number_format($input, 2, ',', '.');
    }
}