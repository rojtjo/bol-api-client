<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Util;

use GuzzleHttp\Psr7\Request;

final class RequestUtil
{
    public const CONTENT_TYPE = 'application/vnd.retailer.v7+json';

    public static function createRequest(string $method, string $uri, array $headers = [], array $query = [], mixed $body = null): Request
    {
        $contentHeaders = [
            'Accept'       => self::CONTENT_TYPE,
            'Content-Type' => self::CONTENT_TYPE,
        ];

        $queryString = self::buildQueryString($query);
        if ($queryString !== '') {
            $uri = "$uri?$queryString";
        }

        if ($body) {
            $body = self::jsonEncode($body);
        }

        $headers = array_merge($contentHeaders, $headers);

        return new Request($method, $uri, $headers, $body);
    }

    private static function buildQueryString(array $query): string
    {
        return http_build_query(array_map(function ($value) {
            if (is_object($value)) {
                if (method_exists($value, 'toString')) {
                    return $value->toString();
                }

                if (enum_exists($value::class, autoload: false)) {
                    return $value->value;
                }
            }

            return $value;
        }, $query));
    }

    public static function jsonEncode(mixed $body): string
    {
        return json_encode($body, JSON_THROW_ON_ERROR);
    }
}
