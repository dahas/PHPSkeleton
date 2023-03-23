<?php declare(strict_types=1);

namespace PHPSkeleton\Library;

use Latte\Engine;
use PHPSkeleton\Sources\Response;

class Latte {

    public const LAYOUT = "layout";

    private Engine $latte;
    private string $layout;
    private Response $response;
    private string $templateDir = ROOT . '/templates';
    private string $cacheDir = ROOT . '/.latte/cache';

    public function __construct(Response $response)
    {
        $this->layout = $_ENV['APP_TEMPLATE_NAME'];
        $this->response = $response;

        $this->latte = new Engine();
        $this->latte->setTempDirectory($this->cacheDir);
        $this->latte->setAutoRefresh($_ENV['MODE'] === 'dev');
    }

    /**
     * Use this method to assign content to template variables. If no file name is given the main layout file is used.
     * 
     * @param string $file | The name of a template file (optional)
     * @param array $_vars | An associative array with template vars: ['var' => $content] (optional)
     */
    public function assignTo(string $file, array $_vars = []): void
    {
        if ($file === 'layout') {
            $file = $this->layout;
        }
        foreach ($_vars as $key => $val) {
            $this->response->assign($file, $key, $val);
        }
    }

    /**
     * Use this method to parse a template. If no file name is given the main layout file is used.
     * 
     * @param string $file | The name of a template file (optional)
     * @param array $_vars | An associative array with template vars: ['var' => $content] (optional)
     */
    public function parse(string $file, array $_vars = []): string
    {
        $vars = $this->response->getVars();
        $tmplVars = array_merge($vars[$file] ?? [], $_vars);
        return $this->latte->renderToString($this->templateDir . '/' . $file, $tmplVars);
    }

    public function render(array $_vars = []): void
    {
        $html = $this->parse($this->layout, $_vars);
        $this->response->write($html);
    }

    private function getArgs($args, &$file, &$_vars)
    {
        if (empty($args)) {
            $file = $this->layout;
            $_vars = [];
        } else if (is_string($args[0])) {
            $file = $args[0];
            $_vars = $args[1] ?? [];
        } else {
            $file = $args[1] ?? $this->layout;
            $_vars = $args[0] ?? [];
        }
    }
}