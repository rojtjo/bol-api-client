<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Types;

use DateTimeImmutable;
use Rojtjo\Bol\Util\Timestamp;

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
                    fulfilmentMethod: FulfilmentMethod::from($item['fulfilmentMethod']),
                    fulfilmentStatus: OrderStatus::from($item['fulfilmentStatus']),
                    quantity: (int) $item['quantity'],
                    quantityShipped: (int) $item['quantityShipped'],
                    quantityCancelled: (int) $item['quantityCancelled'],
                    cancellationRequest: (bool) $item['cancellationRequest'],
                    latestChangedDateTime: Timestamp::parse($item['latestChangedDateTime']),
                ),
                $payload['orderItems'] ?? [],
            ),
        );
    }
}
