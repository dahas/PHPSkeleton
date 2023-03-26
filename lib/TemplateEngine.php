<?php declare(strict_types=1);

namespace PHPSkeleton\Library;

use Latte\Engine;

class TemplateEngine {

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
     * Use this method to parse a template.
     * 
     * @param string $file The name of a template file 
     * @param array $_vars An associative array with template vars (optional)
     * @return string HTML
     */
    public function parse(string $file, array $_vars = []): string
    {
        return $this->latte->renderToString($this->templateDir . '/' . $file, $_vars);
    }
}