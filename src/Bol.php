<?php

declare(strict_types=1);

namespace Rojtjo\Bol;

use Psr\SimpleCache\CacheInterface;
use Rojtjo\Bol\Connectors\OfferConnector;
use Rojtjo\Bol\Connectors\OrderConnector;
use Rojtjo\Bol\Connectors\ProcessStatusConnector;
use Rojtjo\Bol\Connectors\SubscriptionConnector;
use Rojtjo\Bol\Secure\SignatureHeader;
use Rojtjo\Bol\Types\SignatureKeyCollection;

final class Bol
{
    private const CACHE_KEY = '__bol_signature_keys';

    public function __construct(
        private Connection $connection,
        private CacheInterface $cache,
    )
    {
    }

    public function offers(): OfferConnector
    {
        return new OfferConnector($this->connection);
    }

    public function orders(): OrderConnector
    {
        return new OrderConnector($this->connection);
    }

    public function processStatuses(): ProcessStatusConnector
    {
        return new ProcessStatusConnector($this->connection);
    }

    public function subscriptions(): SubscriptionConnector
    {
        return new SubscriptionConnector($this->connection);
    }

    public function validateCredentials(): bool
    {
        try {
            $accessToken = $this->connection->login();
        } catch (BolException $e) {
            return false;
        }

        return $accessToken->isValid();
    }

    public function validateSignature(string $payload, SignatureHeader $header): bool
    {
        $keys = $this->loadSignatureKeys();

        return $keys
            ->byId($header->keyId)
            ->verify($payload, $header->algorithm, $header->signature);
    }

    private function loadSignatureKeys(): SignatureKeyCollection
    {
        $keys = $this->cache->get(self::CACHE_KEY);
        if ($keys === null) {
            $keys = $this->subscriptions()->signatureKeys();

            $this->cache->set(self::CACHE_KEY, $keys);
        }

        return $keys;
    }
}
