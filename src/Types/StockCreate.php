<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Types;

final class StockCreate
{
    public function __construct(
        public readonly int $amount,
        public readonly bool $managedByRetailer,
    )
    {
    }
}
