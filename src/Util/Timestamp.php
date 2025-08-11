<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Util;

use DateTimeImmutable;

final class Timestamp
{
    public static function parse(string $timestamp): DateTimeImmutable
    {
        return self::fromAtom($timestamp)
            ?? self::fromUnixWithMilliseconds($timestamp)
            ?? self::fallback($timestamp);
    }

    private static function fromAtom(string $timestamp): ?DateTimeImmutable
    {
        return DateTimeImmutable::createFromFormat(DateTimeImmutable::ATOM, $timestamp)
            ?: null;
    }

    private static function fromUnixWithMilliseconds(string $timestamp): ?DateTimeImmutable
    {
        $timestamp = substr_replace($timestamp, '.'.substr($timestamp, -3), -3);

        return DateTimeImmutable::createFromFormat('U.u', $timestamp)
            ?: null;
    }

    private static function fallback(string $timestamp): DateTimeImmutable
    {
        return new DateTimeImmutable($timestamp);
    }
}
