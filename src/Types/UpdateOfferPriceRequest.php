<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Types;

final class UpdateOfferPriceRequest
{
    public function __construct(
        public readonly Pricing $pricing,
    )
    {
    }
}
