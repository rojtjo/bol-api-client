<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Types;

final class AdditionalService
{
    public function __construct(
        public readonly string $serviceType,
    )
    {
    }
}
