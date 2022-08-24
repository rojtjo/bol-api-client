<?php

declare(strict_types=1);

namespace Tests\Integration;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use Rojtjo\Bol\Bol;
use Rojtjo\Bol\Connection;
use Rojtjo\Bol\Environment;
use Rojtjo\Bol\Secure\CachedAuthentication;
use Rojtjo\Bol\Secure\ClientCredentialsAuthentication;
use Spatie\Snapshots\MatchesSnapshots;
use Tests\FakeSimpleCache;

abstract class IntegrationTestCase extends TestCase
{
    use MatchesSnapshots;

    protected Bol $bol;

    protected function setUp(): void
    {
        parent::setUp();

        $clientId = $this->envOrSkip('TEST_BOL_CLIENT_ID');
        $clientSecret = $this->envOrSkip('TEST_BOL_CLIENT_SECRET');

        $authentication = new CachedAuthentication(
            new ClientCredentialsAuthentication(
                $clientId,
                $clientSecret,
            ),
            new FakeSimpleCache(),
            'test',
        );

        $this->bol = new Bol(
            new Connection(
                $authentication,
                Environment::Demo,
                new Client(),
            ),
            new FakeSimpleCache(),
        );
    }

    private function envOrSkip(string $key): string
    {
        $value = getenv($key);
        if (empty($value)) {
            $this->markTestSkipped("Environment variable not set: $key");
        }

        return $value;
    }
}
