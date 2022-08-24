<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Types;

final class Violation
{
    public function __construct(
        public readonly string $name,
        public readonly string $reason,
    )
    {
    }
}
