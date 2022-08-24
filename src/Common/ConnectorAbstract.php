<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Common;

use Rojtjo\Bol\Api;
use Rojtjo\Bol\Connection;

abstract class ConnectorAbstract
{
    public function __construct(
        protected Connection $client,
    )
    {
    }

    abstract protected function api(): Api;

    protected function send(string $method, string $uri, array $headers = [], array $query = [], mixed $body = null): mixed
    {
        return $this->client->send($this->api(), $method, $uri, $headers, $query, $body);
    }
}
