<?php declare(strict_types=1);

namespace PHPSkeleton\Controller;

use PHPSkeleton\Library\Navigation;
use PHPSkeleton\Library\TemplateEngine;
use PHPSkeleton\Sources\ControllerBase;

class AppController extends ControllerBase {

    protected $template;
    
    public function __construct()
    {
        parent::__construct();
        
        $this->template = new TemplateEngine();
        $this->template->assign([
            "nav" => Navigation::items()
        ]);
    }
}