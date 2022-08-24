<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Types;

final class CreateOfferRequest
{
    public function __construct(
        public readonly string $ean,
        public readonly Condition $condition,
        public readonly string $reference,
        public readonly bool $onHoldByRetailer,
        public readonly string $unknownProductTitle,
        public readonly Pricing $pricing,
        public readonly StockCreate $stock,
        public readonly Fulfilment $fulfilment,
    )
    {
    }
}
