<?php

namespace Sources;

interface BarIF
{
    public function setVariable($name, $var);
    public function getHtml($template);
}