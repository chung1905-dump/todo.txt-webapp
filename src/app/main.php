<?php

try {
    require_once __DIR__ . '/Request.php';
    Request::init();
    require_once(__DIR__ . '/api.php');
} catch (Throwable $e) {
    throw $e;
}
