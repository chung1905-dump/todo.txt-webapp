<?php

namespace App\Core\Http\Response;

use App\Core\Http\ResponseInterface;

class JsonResponse implements ResponseInterface
{
    private array $body;

    public function return(): void
    {
        echo json_encode([
            'success' => true,
            'data' => $this->getBody(),
        ]);
        exit();
    }

    public function getBody(): array
    {
        return $this->body;
    }

    public function setBody(array $body): self
    {
        $this->body = $body;
        return $this;
    }
}
