<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Types;

final class Condition
{
    public function __construct(
        public readonly ConditionName $name,
        public readonly ?ConditionCategory $category = null,
        public readonly ?string $comment = null,
    )
    {
    }

    public static function new(): self
    {
        return new self(ConditionName::New);
    }
}
