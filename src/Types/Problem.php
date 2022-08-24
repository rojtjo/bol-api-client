<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Types;

final class Problem
{
    public function __construct(
        public readonly string $type,
        public readonly string $title,
        public readonly int $status,
        public readonly string $detail,
        public readonly string $host,
        public readonly string $instance,
        public readonly array $violations,
    )
    {
    }

    public static function fromPayload(array $payload): self
    {
        return new self(
            $payload['type'],
            $payload['type'],
            $payload['status'],
            $payload['detail'],
            $payload['host'],
            $payload['instance'],
            array_map(
                fn (array $violation) => new Violation(
                    $violation['name'],
                    $violation['reason'],
                ),
                $payload['violations'] ?? [],
            ),
        );
    }
}
