<?php

namespace App\Core\Http\Response;

use App\Core\Http\ResponseInterface;

class HtmlResponse implements ResponseInterface
{
    public function return(): void
    {
        exit();
    }
}
