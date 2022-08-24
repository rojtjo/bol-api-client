<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Secure;

use Psr\Http\Client\ClientInterface;
use Psr\SimpleCache\CacheInterface;

class CachedAuthentication implements Authentication
{
    public function __construct(
        private readonly Authentication $authentication,
        private readonly CacheInterface $cache,
        private readonly string $cacheKey,
    )
    {
    }

    public function accessToken(ClientInterface $client): AccessToken
    {
        $accessToken = $this->load();
        if ($accessToken === null || $accessToken->isExpired()) {
            $accessToken = $this->authentication->accessToken($client);

            $this->store($accessToken);
        }

        return $accessToken;
    }

    private function load(): ?AccessToken
    {
        $payload = $this->cache->get($this->cacheKey);
        if ($payload === null) {
            return null;
        }

        return AccessToken::fromPayload($payload);
    }

    private function store(AccessToken $accessToken): void
    {
        $this->cache->set($this->cacheKey, $accessToken->toPayload());
    }
}
