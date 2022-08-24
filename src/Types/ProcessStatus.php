<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Types;

final class ProcessStatus
{
    public function __construct(
        public readonly string $processStatusId,
        public readonly ?string $entityId,
        public readonly string $eventType,
        public readonly string $description,
        public readonly Status $status,
        public readonly ?string $errorMessage,
        public readonly \DateTimeImmutable $createTimestamp,
    )
    {
    }

    public static function fromPayload(array $payload): self
    {
        return new self(
            $payload['processStatusId'],
            $payload['entityId'] ?? null,
            $payload['eventType'],
            $payload['description'],
            new Status($payload['status']),
            $payload['errorMessage'] ?? null,
            new \DateTimeImmutable($payload['createTimestamp']),
        );
    }

    /**
     * Only used for testing
     */
    public function withFixedTimestamp(): self
    {
        return new self(
            $this->processStatusId,
            $this->entityId,
            $this->eventType,
            $this->description,
            $this->status,
            $this->errorMessage,
            new \DateTimeImmutable(
                '2000-01-01 00:00:00',
                new \DateTimeZone('Europe/Amsterdam'),
            ),
        );
    }
}
