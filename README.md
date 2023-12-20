# Bol.com API Client

[![Latest Version on Packagist](https://img.shields.io/packagist/v/rojtjo/bol-api-client.svg?style=flat-square)](https://packagist.org/packages/rojtjo/bol-api-client)
[![Tests](https://github.com/rojtjo/bol-api-client/actions/workflows/tests.yml/badge.svg)](https://github.com/rojtjo/bol-api-client/actions/workflows/tests.yml)

Interact with the Bol.com API v9.

## Installation

You can install the package via composer:

```bash
composer require rojtjo/bol-api-client
```

## Usage

```php
use Rojtjo\Bol\Bol;
use Rojtjo\Bol\Connection;
use Rojtjo\Bol\Environment;
use Rojtjo\Bol\Secure\CachedAuthentication;
use Rojtjo\Bol\Secure\ClientCredentialsAuthentication;
use Rojtjo\Bol\Types\FulfilmentMethod;
use Rojtjo\Bol\Types\OrderStatus;
use Some\Psr\Http\Client\Implementation as Http;
use Some\Psr\SimpleCache\Implementation as Cache;

$http = new Http();
$cache = new Cache();

$bol = new Bol(
    new Connection(
        new CachedAuthentication(
            new ClientCredentialsAuthentication(
                'Your Client ID',
                'Your Client Secret',
            ),
            $cache,
            'bol-credentials-cache',
        ),
        Environment::Demo,
        $http,
    ),
    $cache,
);

// Retrieve an offer
$offer = $bol->offers()->offer('00000000-0000-0000-0000-000000000000');

// Retrieve open orders
$openOrders = $bol->orders()->orders(FulfilmentMethod::ByRetailer, OrderStatus::Open);

```

## Testing

Create a copy of `phpunit.xml.dist` named `phpunit.xml` and fill out the test credentials to be used.

```bash
vendor/bin/phpunit
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
