<?php

namespace PHPSkeleton\Sources;

use PHPSkeleton\Sources\interfaces\ControllerInterface;
use ReflectionClass;

class ControllerBase implements ControllerInterface
{
    public function __construct()
    {
        $this->injectServices('PHPSkeleton\\Services\\');
    }

    /**
     * Use of a ReflectionClass to inject a Service assigned to an Attribute.
     * 
     * @param string $namespace 
     */
    public function injectServices(string $namespace): void
    {
        $rc = new ReflectionClass(get_class($this));
        $properties = $rc->getProperties();
        foreach($properties as $property) {
            $pName = $property->name;
            foreach($property->getAttributes() as $attribute) {
                $service = $attribute->newInstance()->service;
                $sName = $namespace . $service;
                $this->$pName = new $sName();
            }
        }
    }
}