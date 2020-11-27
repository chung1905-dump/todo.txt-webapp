<?php
function newAction(): string
{
    $request = Request::getInstance();

    if ($request->getMethod() !== 'POST') {
        return "Invalid method";
    }

    $post = $request->getPost();
    if (!isset($post['content'])) {
        return "No content";
    }

    global $todoCmd;
    exec($todoCmd . ' add ' . $post['content'], $results);

    return json_encode(['success' => true]);
}

echo newAction();
