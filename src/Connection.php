<?php

declare(strict_types=1);

namespace Rojtjo\Bol;

use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Rojtjo\Bol\Secure\AccessToken;
use Rojtjo\Bol\Secure\Authentication;
use Rojtjo\Bol\Util\RequestUtil;
use Rojtjo\Bol\Util\ResponseUtil;

final class Connection
{
    private ClientInterface $client;
    private Environment $environment;
    private Authentication $authentication;
    private ?AccessToken $accessToken = null;

    public function __construct(Authentication $authentication, Environment $environment, ClientInterface $client)
    {
        $this->authentication = $authentication;
        $this->environment = $environment;
        $this->client = $client;
    }

    public function send(Api $api, string $method, string $uri, array $headers = [], array $query = [], mixed $body = null): mixed
    {
        $request = $this->createRequest($api, $method, $uri, $headers, $query, $body);
        $response = $this->client->sendRequest($request);

        ResponseUtil::assertOk($response);

        return ResponseUtil::decodeBody($response);
    }

    private function createRequest(Api $api, string $method, string $uri, array $headers = [], array $query = [], mixed $body = null): RequestInterface
    {
        $url = $api->urlTo($this->environment, $uri);

        $headers = array_merge($headers, [
            'Authorization' => 'Bearer ' . $this->accessToken()->toString(),
        ]);

        return RequestUtil::createRequest($method, $url, $headers, $query, $body);
    }

    private function accessToken(): AccessToken
    {
        if ($this->accessToken === null || $this->accessToken->isExpired()) {
            $this->accessToken = $this->login();
        }

        return $this->accessToken;
    }

    public function login(): AccessToken
    {
        return $this->authentication->accessToken($this->client);
    }
}
