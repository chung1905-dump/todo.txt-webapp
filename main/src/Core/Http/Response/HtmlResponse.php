<?php

namespace App\Core\Http\Response;

use App\Core\Http\ResponseInterface;

class HtmlResponse implements ResponseInterface
{
    private string $templateDir = '../templates/';

    public function __construct(
        private ?string $template = null
    ) {
    }

    public function return(): void
    {
        if (isset($this->template)) {
            ob_start();
            include_once $this->templateDir . $this->template;
            ob_end_flush();
        }
    }
}
