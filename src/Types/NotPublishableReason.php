<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Types;

final class NotPublishableReason
{
    public function __construct(
        public readonly string $code,
        public readonly string $description,
    )
    {
    }
}
