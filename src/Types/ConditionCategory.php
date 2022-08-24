<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Types;

enum ConditionCategory: string
{
    case New = 'NEW';
    case Secondhand = 'SECONDHAND';
}
