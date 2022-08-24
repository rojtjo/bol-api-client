<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Types;

final class Fulfilment
{
    public function __construct(
        public readonly FulfilmentMethod $method,
        public readonly DeliveryCode $deliveryCode,
    )
    {
    }
}
