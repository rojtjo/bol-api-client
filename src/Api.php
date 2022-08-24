<?php

declare(strict_types=1);

namespace Rojtjo\Bol;

enum Api
{
    public const BASE_URL = 'https://api.bol.com';

    case Advertising;
    case Retailer;
    case Shared;

    public function urlTo(Environment $environment, string $endpoint): string
    {
        return implode('/', [
            self::BASE_URL,
            $this->firstSegment($environment),
            trim($endpoint, '/'),
        ]);
    }

    private function firstSegment(Environment $environment): string
    {
        return match ($environment) {
            Environment::Demo => match ($this) {
                self::Advertising => 'advertiser-demo',
                self::Retailer => 'retailer-demo',
                self::Shared => 'shared-demo',
            },
            Environment::Production => match ($this) {
                self::Advertising => 'advertiser',
                self::Retailer => 'retailer',
                self::Shared => 'shared',
            },
        };
    }
}
