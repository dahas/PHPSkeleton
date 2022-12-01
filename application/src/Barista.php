<?php

namespace PHPSkeleton\Sources;

interface Barista
{
    public function setVariable($name, $var);
    public function getHtml($template);
}