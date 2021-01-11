<?php

namespace App\Controller\Html\Index;

use App\Core\Http;

class IndexController implements Http\ControllerInterface
{
    public function run(Http\Request $request): Http\ResponseInterface
    {
        return new Http\Response\HtmlResponse('index.phtml');
    }
}
