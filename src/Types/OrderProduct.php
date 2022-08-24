<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Types;

final class OrderProduct
{
    public function __construct(
        public readonly string $ean,
        public readonly string $title,
    )
    {
    }
}
