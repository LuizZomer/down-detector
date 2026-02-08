<?php

namespace App\Shared\Helper;

class HttpResponse
{
    public function __construct(
        private int $statusCode
    ) {
    }

    public function isOk(): bool
    {
        return $this->statusCode >= 200 && $this->statusCode < 300;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}
