<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Types;

use DateTimeImmutable;
use Rojtjo\Bol\Common\TypedCollection;
use Rojtjo\Bol\Util\Timestamp;

final class ExportOfferCollection extends TypedCollection
{
    protected function type(): string
    {
        return ExportOffer::class;
    }

    public static function fromPayload(array $payload): self
    {
        return new self(
            array_map(
                fn (array $offer) => new ExportOffer(
                    $offer['offerId'],
                    $offer['ean'],
                    (float) $offer['bundlePricesPrice'],
                    (int) $offer['stockAmount'],
                    strtolower($offer['onHoldByRetailer']) === 'true',
                    new Condition(
                        ConditionName::from($offer['conditionName']),
                        ConditionCategory::tryFrom($offer['conditionCategory'] ?? null),
                        $offer['conditionComment'] ?: null,
                    ),
                    new Fulfilment(
                        FulfilmentMethod::from($offer['fulfilmentType']),
                        DeliveryCode::from($offer['fulfilmentDeliveryCode']),
                    ),
                    Timestamp::parse($offer['mutationDateTime']),
                ),
                $payload,
            ),
        );
    }
}
