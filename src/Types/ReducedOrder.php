<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Types;

final class ReducedOrder
{
    /**
     * @param ReducedOrderItem[] $orderItems
     */
    public function __construct(
        public readonly string $orderId,
        public readonly string $orderPlacedDateTime,
        public readonly array $orderItems,
    )
    {
    }

    public static function fromPayload(array $payload): self
    {
        return new self(
            orderId: (string) $payload['orderId'],
            orderPlacedDateTime: (string) $payload['orderPlacedDateTime'],
            orderItems: array_map(
                fn (array $item) => new ReducedOrderItem(
                    orderItemId: (string) $item['orderItemId'],
                    ean: (string) $item['ean'],
                    quantity: (int) $item['quantity'],
                    quantityShipped: (int) $item['quantityShipped'],
                    quantityCancelled: (int) $item['quantityCancelled'],
                ),
                $payload['orderItems'] ?? [],
            ),
        );
    }
}
