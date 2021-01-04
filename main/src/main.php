<?php

use App\Core\Http;

define('DS', DIRECTORY_SEPARATOR);

try {
    require_once __DIR__ . DS . '..' . DS . 'vendor' . DS . 'autoload.php';
    Http\Request::init();
    $request = Http\Request::getInstance();
    $cm = new Http\ControllerMatcher();
    $cm->match($request)->run($request)->return();
} catch (Throwable $e) {
    throw $e;
}
