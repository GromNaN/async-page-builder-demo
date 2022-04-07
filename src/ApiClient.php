<?php

namespace App;

use Amp\Http\Client\HttpClient;
use Amp\Http\Client\HttpClientBuilder;
use Amp\Http\Client\Request;
use Symfony\Component\Stopwatch\Stopwatch;

class ApiClient
{
    private HttpClient $ampClient;

    public function __construct(
        private readonly string $endpoint,
        private readonly Stopwatch $stopwatch,
    ) {
        $this->ampClient = HttpClientBuilder::buildDefault();
    }

    public function get(string $path): array
    {
        $event = $this->stopwatch->start($path, 'api_client');
        try {
            $response = $this->ampClient->request(new Request($this->endpoint . $path));

            return json_decode($response->getBody()->buffer(), true)['data'];
        } finally {
            $event->stop();
        }
    }
}
