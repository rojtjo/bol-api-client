<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Types;

use DateTimeImmutable;

final class ReducedOrderItem
{
    public function __construct(
        public readonly string $orderItemId,
        public readonly string $ean,
        public readonly FulfilmentMethod $fulfilmentMethod,
        public readonly OrderStatus $fulfilmentStatus,
        public readonly int $quantity,
        public readonly int $quantityShipped,
        public readonly int $quantityCancelled,
        public readonly bool $cancellationRequest,
        public readonly DateTimeImmutable $latestChangedDateTime,
    )
    {
    }
}
