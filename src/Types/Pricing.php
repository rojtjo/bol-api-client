<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Types;

final class Pricing
{
    public function __construct(
        public readonly BundlePriceCollection $bundlePrices,
    )
    {
    }
}
