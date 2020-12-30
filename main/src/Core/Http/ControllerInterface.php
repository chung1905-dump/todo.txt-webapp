<?php

namespace App\Core\Http;

interface ControllerInterface
{
    public function run(Request $request): ResponseInterface;
}
