<?php

define('DS', DIRECTORY_SEPARATOR);

try {
    require_once __DIR__ . DS . '..' . DS . 'vendor' . DS . 'autoload.php';
} catch (Throwable $e) {
    throw $e;
}
