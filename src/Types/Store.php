<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Types;

final class Store
{
    public function __construct(
        public readonly string $productTitle,
        public readonly CountryCodeCollection $visible,
    )
    {
    }
}
