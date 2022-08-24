<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Types;

final class BundlePrice
{
    public function __construct(
        public readonly int $quantity,
        public readonly float $unitPrice,
    )
    {
    }
}
