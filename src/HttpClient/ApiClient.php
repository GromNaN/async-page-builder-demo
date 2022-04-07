<?php

namespace App\HttpClient;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use function Amp\delay;

class ApiClient
{
    //private readonly HttpClientInterface $httpClient;

    public function __construct(
        private readonly HttpClientInterface $httpClient,
        private readonly string $endpoint,
    ) {
        //$this->httpClient = new FiberAmpHttpClient();
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
