<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Secure;

use PHPUnit\Framework\TestCase;

final class AccessTokenTest extends TestCase
{
    /** @test */
    public function access_token_can_be_expired(): void
    {
        $token = new AccessToken('foo', new \DateTimeImmutable());

        $this->assertTrue($token->isExpired(), 'Expected access token to be expired');
    }
}
