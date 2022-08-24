<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Types;

final class Stock
{
    public function __construct(
        public readonly int $amount,
        public readonly int $correctedStock,
        public readonly bool $managedByRetailer,
    )
    {
    }
}
