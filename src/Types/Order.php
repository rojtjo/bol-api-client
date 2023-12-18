<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Types;

use DateTimeImmutable;

final class Order
{
    public function __construct(
        public readonly string $orderId,
        public readonly bool $pickupPoint,
        public readonly string $orderPlacedDateTime,
        public readonly ShipmentDetails $shipmentDetails,
        public readonly BillingDetails $billingDetails,
        public readonly OrderItemCollection $orderItems,
    )
    {
    }

    public static function fromPayload(array $payload): self
    {
        return new self(
            $payload['orderId'],
            $payload['pickupPoint'],
            $payload['orderPlacedDateTime'],
            new ShipmentDetails(
                $payload['shipmentDetails']['pickupPointName'] ?? null,
                $payload['shipmentDetails']['salutation'],
                $payload['shipmentDetails']['firstName'],
                $payload['shipmentDetails']['surname'],
                $payload['shipmentDetails']['streetName'],
                $payload['shipmentDetails']['houseNumber'],
                $payload['shipmentDetails']['houseNumberExtension'] ?? null,
                $payload['shipmentDetails']['extraAddressInformation'] ?? null,
                $payload['shipmentDetails']['zipCode'],
                $payload['shipmentDetails']['city'],
                $payload['shipmentDetails']['countryCode'],
                $payload['shipmentDetails']['email'],
                $payload['shipmentDetails']['company'] ?? null,
                $payload['shipmentDetails']['deliveryPhoneNumber'] ?? null,
                $payload['shipmentDetails']['language'],
            ),
            new BillingDetails(
                $payload['billingDetails']['salutation'],
                $payload['billingDetails']['firstName'],
                $payload['billingDetails']['surname'],
                $payload['billingDetails']['streetName'],
                $payload['billingDetails']['houseNumber'],
                $payload['billingDetails']['houseNumberExtension'] ?? null,
                $payload['billingDetails']['extraAddressInformation'] ?? null,
                $payload['billingDetails']['zipCode'],
                $payload['billingDetails']['city'],
                $payload['billingDetails']['countryCode'],
                $payload['billingDetails']['email'],
                $payload['billingDetails']['company'] ?? null,
                $payload['billingDetails']['vatNumber'] ?? null,
                $payload['billingDetails']['kvkNumber'] ?? null,
                $payload['billingDetails']['orderReference'] ?? null,
            ),
            new OrderItemCollection(
                array_map(
                    fn (array $orderItem) => new OrderItem(
                        $orderItem['orderItemId'],
                        $orderItem['cancellationRequest'],
                        new OrderFulfilment(
                            $orderItem['fulfilment']['method'],
                            $orderItem['fulfilment']['distributionParty'] ?? 'BOL',
                            $orderItem['fulfilment']['latestDeliveryDate'] ?? null,
                            $orderItem['fulfilment']['exactDeliveryDate'] ?? null,
                            $orderItem['fulfilment']['expiryDate'],
                            $orderItem['fulfilment']['timeFrameType'],
                        ),
                        new OrderOffer(
                            $orderItem['offer']['offerId'],
                            $orderItem['offer']['reference'] ?? null,
                        ),
                        new OrderProduct(
                            $orderItem['product']['ean'],
                            $orderItem['product']['title'],
                        ),
                        (int) $orderItem['quantity'],
                        (int) $orderItem['quantityShipped'],
                        (int) $orderItem['quantityCancelled'],
                        $orderItem['unitPrice'],
                        $orderItem['commission'],
                        new AdditionalServiceCollection(
                            array_map(
                                fn (array $additionalService) => new AdditionalService(
                                    $additionalService['serviceType'],
                                ),
                                $orderItem['additionalServices'] ?? [],
                            ),
                        ),
                        new DateTimeImmutable($orderItem['latestChangedDateTime'])
                    ),
                    $payload['orderItems'],
                ),
            ),
        );
    }
}
