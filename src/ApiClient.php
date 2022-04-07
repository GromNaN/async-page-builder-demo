<?php

namespace App;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use function Amp\delay;

class ApiClient
{
    public function __construct(
        private readonly HttpClientInterface $httpClient,
        private readonly string $endpoint,
    ) {
    }

    public function get(string $path): array
    {
        $response = $this->httpClient->request('GET', $path, [
            'base_uri' => $this->endpoint,
        ]);

        // Wait for the next tick
        delay(0);

        return $response->toArray()['data'];
    }
}
