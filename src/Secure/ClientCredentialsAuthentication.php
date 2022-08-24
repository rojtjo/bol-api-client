<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Secure;

use GuzzleHttp\Psr7\Request;
use Psr\Http\Client\ClientInterface;
use Rojtjo\Bol\Util\ResponseUtil;

final class ClientCredentialsAuthentication implements Authentication
{
    private const AUTH_URL = 'https://login.bol.com/token?grant_type=client_credentials';

    public function __construct(
        private string $clientId,
        private string $clientSecret,
    )
    {
    }

    public function accessToken(ClientInterface $client): AccessToken
    {
        $token = base64_encode("$this->clientId:$this->clientSecret");
        $response = $client->sendRequest(new Request('POST', self::AUTH_URL, [
            'Accept'        => 'application/json',
            'Authorization' => "Basic $token",
        ]));

        ResponseUtil::assertOk($response);

        $data = ResponseUtil::decodeJson($response);

        return AccessToken::fromPayload($data);
    }
}
