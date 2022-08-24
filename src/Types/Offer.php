<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Types;

final class Offer
{
    public function __construct(
        public readonly string $offerId,
        public readonly string $ean,
        public readonly ?string $reference,
        public readonly bool $onHoldByRetailer,
        public readonly ?string $unknownProductTitle,
        public readonly Pricing $pricing,
        public readonly Stock $stock,
        public readonly Fulfilment $fulfilment,
        public readonly Store $store,
        public readonly Condition $condition,
        public readonly NotPublishableReasonCollection $notPublishableReasons,
    )
    {
    }

    public static function fromPayload(array $payload): self
    {
        return new self(
            $payload['offerId'],
            $payload['ean'],
            $payload['reference'] ?? null,
            $payload['onHoldByRetailer'],
            $payload['unknownProductTitle'] ?? null,
            new Pricing(
                new BundlePriceCollection(
                    array_map(
                        fn (array $bundlePrice) => new BundlePrice(
                            $bundlePrice['quantity'],
                            $bundlePrice['unitPrice'],
                        ),
                        $payload['pricing']['bundlePrices'],
                    )
                ),
            ),
            new Stock(
                $payload['stock']['amount'],
                $payload['stock']['correctedStock'],
                $payload['stock']['managedByRetailer'],
            ),
            new Fulfilment(
                FulfilmentMethod::from($payload['fulfilment']['method']),
                DeliveryCode::from($payload['fulfilment']['deliveryCode']),
            ),
            new Store(
                $payload['store']['productTitle'],
                new CountryCodeCollection(
                    array_map(
                        fn (array $visible) => new CountryCode(
                            $visible['countryCode'],
                        ),
                        $payload['store']['visible'] ?? [],
                    ),
                ),
            ),
            new Condition(
                ConditionName::from($payload['condition']['name']),
                ConditionCategory::tryFrom($payload['condition']['category'] ?? ''),
                $payload['condition']['comment'] ?? null,
            ),
            new NotPublishableReasonCollection(
                array_map(
                    fn (array $notPublishableReason) => new NotPublishableReason(
                        $notPublishableReason['code'],
                        $notPublishableReason['description'],
                    ),
                    $payload['notPublishableReasons'] ?? [],
                )
            )
        );
    }
}
