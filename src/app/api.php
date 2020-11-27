<?php

function run(): void
{
    $request = Request::getInstance();

    $action = $request->getPath()[1];
    $filename = __DIR__ . '/api/' . $action . '.php';

    if (is_file($filename)) {
        require_once($filename);
    } else {
        echo 'No action for ' . $action;
    }
}

run();
