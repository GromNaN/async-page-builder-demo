<?php

namespace App\HttpClient;

use Amp\Http\Client\HttpClient;
use Amp\Http\Client\HttpClientBuilder;
use Amp\Http\Client\Request;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Symfony\Contracts\HttpClient\ResponseStreamInterface;

/**
 * Very partial implementation of HTTP client using AMP and Fibers
 */
class FiberAmpHttpClient implements HttpClientInterface
{
    private readonly MockHttpClient $httpClient;
    public function __construct()
    {
        $ampClient = (new HttpClientBuilder())->build();

        $this->httpClient = new MockHttpClient(function (string $method, string $url, array $options = []) use ($ampClient) {
            $response = $ampClient->request(new Request($url, $method));

            return new MockResponse($response->getBody()->buffer());
        });
    }

    public function request(string $method, string $url, array $options = []): ResponseInterface
    {
        return $this->httpClient->request($method, $url, $options);
    }

    public function stream(iterable|ResponseInterface $responses, float $timeout = null): ResponseStreamInterface
    {
        throw new \BadMethodCallException('Not implemented');
    }

    public function withOptions(array $options): static
    {
        throw new \BadMethodCallException('Not implemented');
    }
}
