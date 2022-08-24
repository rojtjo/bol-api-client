<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Types;

final class OrderOffer
{
    public function __construct(
        public readonly string $offerId,
        public readonly string $reference,
    )
    {
    }
}
