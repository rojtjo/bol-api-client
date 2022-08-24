<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Secure;

use DateTimeInterface;

final class AccessToken
{
    public function __construct(
        private string $accessToken,
        private \DateTimeImmutable $expiresAt,
    )
    {
    }

    public static function fromPayload(array $payload): self
    {
        return new self(
            $payload['access_token'],
            self::parseExpiresAt($payload),
        );
    }

    private static function parseExpiresAt(array $payload): \DateTimeImmutable
    {
        // When we receive an expires_in we need to add those as seconds to
        // the current timestamp to get the expires_at value
        $expiresIn = $payload['expires_in'] ?? null;
        if ($expiresIn) {
            $interval = new \DateInterval("PT{$expiresIn}S");
            return (new \DateTimeImmutable())->add($interval);
        }

        return \DateTimeImmutable::createFromFormat(DateTimeInterface::ATOM, $payload['expires_at']);
    }

    public function toPayload(): array
    {
        return [
            'access_token' => $this->accessToken,
            'expires_at'   => $this->expiresAt->format(\DateTimeInterface::ATOM),
        ];
    }

    public function isExpired(): bool
    {
        $now = new \DateTimeImmutable();

        return $now >= $this->expiresAt;
    }

    public function isValid(): bool
    {
        return ! $this->isExpired();
    }

    public function toString(): string
    {
        return $this->accessToken;
    }
}
