<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Types;

final class Event
{
    public function __construct(
        public readonly string $resource,
        public readonly string $type,
        public readonly string $resourceId,
    )
    {
    }
}
