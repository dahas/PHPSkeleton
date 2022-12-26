<?php

namespace PHPSkeleton\Sources\interfaces;

interface Bars  // <-- When implementing this Interface its Methods must be implemented in the Class as well
{
    public function setVariable($name, $var);

    public function getHtml($template);
}