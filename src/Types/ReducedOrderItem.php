<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Types;

final class ReducedOrderItem
{
    public function __construct(
        public readonly string $orderItemId,
        public readonly string $ean,
        public readonly int $quantity,
        public readonly int $quantityShipped,
        public readonly int $quantityCancelled,
    )
    {
    }
}
