<?php declare(strict_types=1);

namespace PHPSkeleton\Sources;

use Latte\Engine;

class Latte {

    private Engine $latte;
    private string $templateDir = ROOT . '/templates';
    private string $cacheDir = ROOT . '/.latte/cache';

    public function __construct()
    {
        $this->latte = new Engine();
        $this->latte->setTempDirectory($this->cacheDir);
        $this->latte->setAutoRefresh($_ENV['MODE'] === 'dev');
    }

    public function parse(string $file, array $params = [], string $block = null): string
    {
        return $this->latte->renderToString($this->templateDir . '/' . $file, $params, $block);
    }
}