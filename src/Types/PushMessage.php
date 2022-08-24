<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Types;

use DateTimeImmutable;

final class PushMessage
{
    public function __construct(
        public readonly int $retailerId,
        public readonly DateTimeImmutable $timestamp,
        public readonly Event $event,
    )
    {
    }

    public static function fromPayload(array $payload): self
    {
        return new self(
            $payload['retailerId'],
            new DateTimeImmutable($payload['timeStamp']),
            new Event(
                $payload['event']['resource'],
                $payload['event']['type'],
                $payload['event']['resourceId'],
            ),
        );
    }
}
