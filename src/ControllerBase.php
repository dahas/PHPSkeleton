<?php

namespace PHPSkeleton\Sources;

use ReflectionClass;

class ControllerBase
{
    public function __construct()
    {
        $this->injectServices('PHPSkeleton\\Services\\');
    }

    public function injectServices($namespace)
    {
        $rc = new ReflectionClass(get_class($this));  // <-- Reflection class returns details of a class
        $properties = $rc->getProperties();
        foreach($properties as $property) {
            $pName = $property->name;
            foreach($property->getAttributes() as $attribute) {
                $service = $attribute->newInstance()->service;
                $sName = $namespace . $service;
                $this->$pName = new $sName();  // <-- Create instance of a Service and make it accessible in the child class
            }
        }
    }
}