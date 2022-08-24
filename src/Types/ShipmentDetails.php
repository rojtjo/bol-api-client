<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Types;

final class ShipmentDetails
{
    public function __construct(
        public readonly ?string $pickupPointName,
        public readonly string $salutation,
        public readonly string $firstName,
        public readonly string $surname,
        public readonly string $streetName,
        public readonly string $houseNumber,
        public readonly ?string $houseNumberExtension,
        public readonly ?string $extraAddressInformation,
        public readonly string $zipCode,
        public readonly string $city,
        public readonly string $countryCode,
        public readonly string $email,
        public readonly ?string $company,
        public readonly ?string $deliveryPhoneNumber,
        public readonly string $language,
    )
    {
    }
}
