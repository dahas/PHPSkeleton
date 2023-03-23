<?php declare(strict_types=1);

namespace PHPSkeleton\Library;

use Latte\Engine;
use PHPSkeleton\Sources\Response;

class Latte {

    private Engine $latte;
    private Response $response;
    private string $templateDir = ROOT . '/templates';
    private string $cacheDir = ROOT . '/.latte/cache';

    public function __construct(Response $response)
    {
        $this->response = $response;
        $this->latte = new Engine();
        $this->latte->setTempDirectory($this->cacheDir);
        $this->latte->setAutoRefresh($_ENV['MODE'] === 'dev');
    }

    public function getEngine(): Engine
    {
        return $this->latte;
    }

    public function parse(string $file, string $var, array $_vars = []): void
    {
        $html = $this->latte->renderToString($this->templateDir . '/' . $file, $_vars);
        $this->response->assign($var, $html);
    }

    public function render(string $file, array $_vars = []): void
    {
        $html = $this->latte->renderToString($this->templateDir . '/' . $file, array_merge($_vars, $this->response->getVars()));
        $this->response->write($html);
    }
}