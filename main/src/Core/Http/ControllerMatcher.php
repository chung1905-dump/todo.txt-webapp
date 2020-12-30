<?php

namespace App\Core\Http;

class ControllerMatcher
{
    public function match(Request $request): ?ControllerInterface
    {
        $class = $this->getControllerClass(
            $request->getType(),
            $request->getGroup(),
            $request->getController()
        );

        if (!class_exists($class)) {
            throw new \Exception("Controller $class not found");
        }

        $controller = new $class($request);
        if (!$controller instanceof ControllerInterface) {
            throw new \Exception("$class not implement ControllerInterface");
        }

        return $controller;
    }

    private function getControllerClass(
        string $type = Request::DEFAULT_TYPE,
        string $group = Request::DEFAULT_GROUP,
        string $controller = Request::DEFAULT_CONTROLLER,
        string $namespace = 'App'
    ): string {
        return sprintf(
            '%s\\Controller\\%s\\%s\\%sController',
            $namespace,
            ucfirst($type),
            ucfirst($group),
            ucfirst($controller),
        );
    }
}
