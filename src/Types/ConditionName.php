<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Types;

enum ConditionName: string
{
    case New = 'NEW';
    case AsNew = 'AS_NEW';
    case Good = 'GOOD';
    case Reasonable = 'REASONABLE';
    case Moderate = 'MODERATE';
}
