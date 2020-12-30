<?php

use App\Core\Http;

define('DS', DIRECTORY_SEPARATOR);

try {
    require_once __DIR__ . DS . '..' . DS . 'vendor' . DS . 'autoload.php';
    Http\Request::init();
    $cm = new Http\ControllerMatcher();
    $cm->match(Http\Request::getInstance())->run()->return();
} catch (Throwable $e) {
    throw $e;
}
