<?php

use App\Core\Http;
use App\Core\Http\Response\JsonResponse;

class ListController implements Http\ControllerInterface
{
    public function run(Http\Request $request): Http\ResponseInterface
    {
        $res = new JsonResponse();
    }
}
