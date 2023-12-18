<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Types;

enum OrderStatus: string
{
    case Open = 'OPEN';

    case Shipped = 'shipped';

    case All = 'ALL';
}
