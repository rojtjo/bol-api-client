<?php

declare(strict_types=1);

namespace Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

final class FakeHttpFactory
{
    public static function client(array $responses): Client
    {
        $mock = new MockHandler($responses);

        $handlerStack = HandlerStack::create($mock);

        return new Client(['handler' => $handlerStack]);
    }

    public static function jsonResponse(int $statusCode, array $data, array $headers = []): Response
    {
        return new Response($statusCode, $headers, json_encode($data));
    }
}
