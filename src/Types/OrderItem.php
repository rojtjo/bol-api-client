<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Types;

use DateTimeImmutable;

final class OrderItem
{
    public function __construct(
        public readonly string $orderItemId,
        public readonly bool $cancellationRequest,
        public readonly OrderFulfilment $fulfilment,
        public readonly OrderOffer $offer,
        public readonly OrderProduct $product,
        public readonly int $quantity,
        public readonly int $quantityShipped,
        public readonly int $quantityCancelled,
        public readonly float $unitPrice,
        public readonly float $commission,
        public readonly AdditionalServiceCollection $additionalServices,
        public readonly DateTimeImmutable $latestChangedDateTime,
    )
    {
    }
}
