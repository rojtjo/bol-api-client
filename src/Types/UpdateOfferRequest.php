<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Types;

final class UpdateOfferRequest
{
    public function __construct(
        public readonly string $reference,
        public readonly bool $onHoldByRetailer,
        public readonly string $unknownProductTitle,
        public readonly Fulfilment $fulfilment,
    )
    {
    }
}
