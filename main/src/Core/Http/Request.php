<?php

namespace App\Core\Http;

class Request
{
    public const DEFAULT_TYPE = 'html';
    public const DEFAULT_GROUP = 'index';
    public const DEFAULT_CONTROLLER = 'index';

    private static Request $instance;

    private string $method;

    private string $type;

    private string $group;

    private string $controller;

    private array $path;

    private array $parameters;

    private array $post;

    private function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->post = $this->initJson();
        $this->sequenceInits();
    }

    private function sequenceInits()
    {
        $this->path = $this->initPath();
        $this->type = $this->initType();
        $this->group = $this->initGroup();
        $this->controller = $this->initController();
        $this->parameters = $this->initParameters();
    }

    private function initType(): string
    {
        if (!isset($this->path[0])) {
            return self::DEFAULT_TYPE;
        }

        if ($this->path[0] === 'api' || $this->path[0] === 'json') {
            return 'json';
        }

        return self::DEFAULT_TYPE;
    }

    private function initGroup(): string
    {
        $i = $this->type === self::DEFAULT_TYPE ? 0 : 1;
        return isset($this->path[$i]) ? $this->path[$i] : self::DEFAULT_GROUP;
    }

    private function initController(): string
    {
        $i = $this->type === self::DEFAULT_TYPE ? 1 : 2;
        return isset($this->path[$i]) ? $this->path[$i] : self::DEFAULT_CONTROLLER;
    }

    private function initParameters(): array
    {
        $i = $this->type === self::DEFAULT_TYPE ? 2 : 3;

        $path = array_slice($this->getPath(), $i);
        $params = [];

        $j = 0;
        while ($j < count($path)) {
            if (!isset($path[$j])) {
                break;
            }
            if (isset($path[$j + 1])) {
                $params[$path[$j]] = $path[$j + 1];
            } else {
                $params[$path[$j]] = true;
            }

            $j += 2;
        }

        return $params;
    }

    private function initJson(): array
    {
        $body = [];
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            //Receive the RAW post data.
            $content = trim(file_get_contents("php://input"));
            $body = json_decode($content, true);
            if (!is_array($body)) {
                $body = [];
            }
        }

        return $body;
    }

    private function initPath(): array
    {
        return explode('/', trim($_SERVER['REQUEST_URI'], '/'));
    }

    public static function init(): void
    {
        if (isset(self::$instance)) {
            throw new \Exception("Request already initialized");
        }

        self::$instance = new Request();
    }

    public static function getInstance(): Request
    {
        return self::$instance;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getGroup(): string
    {
        return $this->group;
    }

    public function getController(): string
    {
        return $this->controller;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getPath(): array
    {
        return $this->path;
    }

    public function getParameters(): array
    {
        return $this->parameters;
    }

    public function getPost(): array
    {
        return $this->post;
    }
}
