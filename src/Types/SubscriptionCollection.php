<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Types;

use Rojtjo\Bol\Common\TypedCollection;

final class SubscriptionCollection extends TypedCollection
{
    protected function type(): string
    {
        return Subscription::class;
    }

    public static function fromPayload(array $payload): self
    {
        return new self(
            array_map(
                fn (array $subscription) => Subscription::fromPayload($subscription),
                $payload['subscriptions'] ?? [],
            ),
        );
    }
}
