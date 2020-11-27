<?php

function listAction(): string
{
    $request = Request::getInstance();

    if ($request->getMethod() !== 'GET') {
        return "Invalid method";
    }

    global $todoCmd;
    exec($todoCmd . ' ls', $results);
    $data = [];

    foreach ($results as $line) {
        $task = [];
        // make numbers into links for js
        preg_match('/(^[0-9]+)\s+(.*)/', $line, $matches);
        if (!isset($matches[1], $matches[2])) {
            continue;
        }

        $task['id'] = intval($matches[1]);
        $content = $matches[2];

        $task['content'] = $content;

        // make projects and contexts into links for js
        // contexts (@) and projects (+)
        $data[] = $task;
    }

    return json_encode([
        'success' => true,
        'data' => $data,
    ]);
}

echo listAction();
