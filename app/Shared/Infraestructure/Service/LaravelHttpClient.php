<?php

namespace App\Shared\Infraestructure\Service;

use App\Shared\Domain\Services\HttpClientInterface;
use App\Shared\Helper\HttpResponse;
use Illuminate\Support\Facades\Http;

class LaravelHttpClient implements HttpClientInterface
{
    public function get(string $url): HttpResponse
    {
        $response = Http::get($url);

        return new HttpResponse(
            statusCode: $response->status()
        );
    }
}
