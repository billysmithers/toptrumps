<?php

namespace Tests\Shared\Lego;

use App\Api\Lego\Client;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use Psr\Http\Message\ResponseInterface;

class MockClient extends Client
{
    private HttpClient $httpClient;

    public function __construct(
        ?array $queue = null,
        ?callable $onFulfilled = null,
        ?callable $onRejected = null
    ) {
        parent::__construct();

        $mock = new MockHandler($queue, $onFulfilled, $onRejected);

        $stack = HandlerStack::create($mock);

        $this->httpClient = new HttpClient([
            'handler' => $stack,
        ]);
    }

    public function request($method, $uri = '', array $options = []): ResponseInterface
    {
        return $this->httpClient->request($method, $uri, $options);
    }
}
