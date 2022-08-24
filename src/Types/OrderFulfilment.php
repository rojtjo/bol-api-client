<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Types;

final class OrderFulfilment
{
    public function __construct(
        public readonly string $method,
        public readonly string $distributionParty,
        public readonly ?string $latestDeliveryDate,
        public readonly ?string $exactDeliveryDate,
        public readonly string $expiryDate,
        public readonly string $timeFrameType,
    )
    {
    }
}
