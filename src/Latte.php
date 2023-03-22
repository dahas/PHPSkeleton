<?php declare(strict_types=1);

namespace PHPSkeleton\Sources;

use Latte\Engine;

class Latte {

    private Engine $latte;
    private string $templateDir = ROOT . '/templates';
    private string $cacheDir = ROOT . '/.latte/cache';
    private array $templateVars = [];

    public function __construct()
    {
        $this->latte = new Engine();
        $this->latte->setTempDirectory($this->cacheDir);
        $this->latte->setAutoRefresh($_ENV['MODE'] === 'dev');
    }

    public function getEngine(): Engine
    {
        return $this->latte;
    }

    public function getVars(): array
    {
        return $this->templateVars;
    }

    public function parse(string $file, array $_vars = [], string $block = null): string
    {
        return $this->latte->renderToString($this->templateDir . '/' . $file, $_vars, $block);
    }

    public function assign(string $_var, string $html): void
    {
        $this->templateVars[$_var] = $html;
    }

    public function render(string $file, array $_vars = []): string
    {
        $tmplVars = array_merge($this->templateVars, $_vars);
        return $this->parse($file, $tmplVars);
    }
}