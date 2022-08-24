<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Types;

enum FulfilmentMethod: string
{
    case ByRetailer = 'FBR';
    case ByBol = 'FBB';
}
