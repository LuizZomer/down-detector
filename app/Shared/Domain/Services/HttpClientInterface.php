<?php

namespace App\Shared\Domain\Services;

use App\Shared\Helper\HttpResponse;

interface HttpClientInterface
{
    public function get(string $url): HttpResponse;
}
