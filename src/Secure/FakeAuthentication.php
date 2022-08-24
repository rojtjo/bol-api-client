<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Secure;

use Psr\Http\Client\ClientInterface;

final class FakeAuthentication implements Authentication
{
    public function accessToken(ClientInterface $client): AccessToken
    {
        $accessToken = random_bytes(16);
        $expiresAt = new \DateTimeImmutable('+5 minutes');

        return new AccessToken($accessToken, $expiresAt);
    }
}
