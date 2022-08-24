<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Types;

final class CountryCode
{
    public function __construct(
        public readonly string $countryCode,
    )
    {
    }
}
