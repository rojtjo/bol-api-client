<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Util;

use League\Csv\Reader;
use Psr\Http\Message\ResponseInterface;
use Rojtjo\Bol\BolException;

final class ResponseUtil
{
    public static function assertOk(ResponseInterface $response): void
    {
        $statusCode = $response->getStatusCode();

        if ($statusCode < 200 || $statusCode > 300) {
            throw BolException::fromResponse($response);
        }
    }

    public static function decodeBody(ResponseInterface $response): mixed
    {
        $contentType = $response->getHeaderLine('Content-Type');
        if (str_contains($contentType, 'application/vnd.retailer.v10+json')) {
            return self::decodeJson($response);
        }

        if (str_contains($contentType, 'text/csv')) {
            return self::decodeCsv($response);
        }

        return self::readBody($response);
    }

    public static function decodeCsv(ResponseInterface $response): array
    {
        $body = self::readBody($response);

        $records = Reader::createFromString($body)
            ->setHeaderOffset(0)
            ->getRecords();

        return iterator_to_array($records, false);
    }

    public static function decodeJson(ResponseInterface $response): mixed
    {
        $body = self::readBody($response);

        return json_decode($body, true, flags: JSON_THROW_ON_ERROR);
    }

    public static function readBody(ResponseInterface $response): string
    {
        $response->getBody()->rewind();

        return $response->getBody()->getContents();
    }
}
