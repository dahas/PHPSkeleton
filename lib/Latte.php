<?php declare(strict_types=1);

namespace PHPSkeleton\Library;

use Latte\Engine;
use PHPSkeleton\Sources\HtmlAdapter;
use PHPSkeleton\Sources\Request;
use PHPSkeleton\Sources\Response;

class Latte {

    private Engine $latte;

    public function __construct(
        private string $templateDir = ROOT . '/templates',
        private string $cacheDir = ROOT . '/.latte/cache'
    ) {
        $this->latte = new Engine();
        $this->latte->setTempDirectory($this->cacheDir);
        $this->latte->setAutoRefresh($_ENV['MODE'] === 'dev');
    }

    /**
     * Use this method to parse a template. If no file name is given the main layout file is used.
     * 
     * @param string $file The name of a template file (optional)
     * @param array $_vars An associative array with template vars (optional)
     * @return string HTML
     */
    public function parse(string $file, array $_vars = []): string
    {
        return $this->latte->renderToString($this->templateDir . '/' . $file, $_vars);
    }
}