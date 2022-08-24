<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Common;

use Illuminate\Support\Collection;
use Webmozart\Assert\Assert;

// Very loosely typed ;)
abstract class TypedCollection extends Collection
{
    public function __construct($items = [])
    {
        Assert::allIsInstanceOf($items, $this->type());

        parent::__construct($items);
    }

    abstract protected function type(): string;
}
