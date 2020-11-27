<?php

class Request
{
    private static Request $instance;

    private string $method;

    private array $path;

    private array $parameters;

    private array $post;

    private function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->path = $this->initPath();
        $this->parameters = $_GET;
        $this->post = $this->initJson();
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
        return explode('/', ltrim($_SERVER['REQUEST_URI'], '/'));
    }

    public static function init()
    {
        if (isset(self::$instance)) {
            throw new Exception("Request already initialized");
        }

        self::$instance = new Request();
    }

    public static function getInstance(): Request
    {
        return self::$instance;
    }

    public function getMethod()
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
