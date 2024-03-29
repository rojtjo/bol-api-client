<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Types;

final class Subscription
{
    public function __construct(
        public readonly string $id,
        public readonly array $resources,
        public readonly string $url,
        public readonly SubscriptionType $subscriptionType,
        public readonly bool $enabled,
    )
    {
    }

    public static function fromPayload(array $subscription): self
    {
        return new self(
            $subscription['id'],
            $subscription['resources'],
            $subscription['url'],
            SubscriptionType::from($subscription['subscriptionType']),
            $subscription['enabled'],
        );
    }
}
