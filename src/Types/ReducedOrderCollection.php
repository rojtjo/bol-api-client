<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Types;

use Rojtjo\Bol\Common\TypedCollection;

final class ReducedOrderCollection extends TypedCollection
{
    protected function type(): string
    {
        return ReducedOrder::class;
    }

    public static function fromPayload(array $payload): self
    {
        return new self(
            array_map(
                fn (array $order) => ReducedOrder::fromPayload($order),
                $payload['orders'] ?? [],
            )
        );
    }
}
