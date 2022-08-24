<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Types;

use DateTimeImmutable;

final class ExportOffer
{
    public function __construct(
        public readonly string $offerId,
        public readonly string $ean,
        public readonly float $bundlePricesPrice,
        public readonly int $stockAmount,
        public readonly bool $onHoldByRetailer,
        public readonly Condition $condition,
        public readonly Fulfilment $fulfilment,
        public readonly DateTimeImmutable $mutationDateTime,
    )
    {
    }
}
