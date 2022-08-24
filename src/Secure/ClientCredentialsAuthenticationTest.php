<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Secure;

use PHPUnit\Framework\TestCase;
use Tests\FakeHttpFactory;

final class ClientCredentialsAuthenticationTest extends TestCase
{
    /** @test */
    public function authenticate(): void
    {
        $client = FakeHttpFactory::client([
            FakeHttpFactory::jsonResponse(200, [
                'expires_in'   => 123,
                'access_token' => 'foo bar',
            ]),
        ]);

        $authentication = new ClientCredentialsAuthentication('foo', 'bar');

        $accessToken = $authentication->accessToken($client);

        $this->assertSame('foo bar', $accessToken->toString());
    }
}
