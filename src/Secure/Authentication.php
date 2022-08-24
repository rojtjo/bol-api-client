<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Secure;

use Psr\Http\Client\ClientInterface;

interface Authentication
{
    public function accessToken(ClientInterface $client): AccessToken;
}
