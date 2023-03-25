<?php

namespace PHPSkeleton\Sources;

class Html {

    private string $content = "";
    private array $templateVars = [];

    public function write(string $content): void
    {
        $this->content .= $content;
    }

    public function assignContent(string $tmpl, string $var, string $content): void
    {
        $this->templateVars[$tmpl][$var] = $content;
    }

    public function getVars(): array
    {
        return $this->templateVars;
    }

    public function flush(): void
    {
        header('Content-Type: text/html');
        print $this->content;
        $this->content = "";
    }
}