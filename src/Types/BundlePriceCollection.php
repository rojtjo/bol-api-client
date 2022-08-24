<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Types;

use Rojtjo\Bol\Common\TypedCollection;

final class BundlePriceCollection extends TypedCollection
{
    protected function type(): string
    {
        return BundlePrice::class;
    }
}
