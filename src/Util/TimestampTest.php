<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Util;

use PHPUnit\Framework\TestCase;

final class TimestampTest extends TestCase
{
    /**
     * @test
     * @dataProvider timestamps
     */
    public function parse_timestamp(string $input, string $atom): void
    {
        $dt = Timestamp::parse($input);

        $this->assertSame($atom, $dt->format(\DateTimeImmutable::ATOM));
    }

    public function timestamps(): array
    {
        return [
            'atom format' => ['2025-08-11T07:10:25+00:00', '2025-08-11T07:10:25+00:00'],
            'unix timestamp with milliseconds' => ['1754896225000', '2025-08-11T07:10:25+00:00'],
            'date string' => ['2025-08-11', '2025-08-11T00:00:00+00:00'],
        ];
    }
}
