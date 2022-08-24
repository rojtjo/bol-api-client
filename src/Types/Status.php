<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Types;

final class Status
{
    public function __construct(
        private string $status,
    )
    {
    }

    public static function pending(): self
    {
        return new self('PENDING');
    }

    public function isPending(): bool
    {
        return $this->status === 'PENDING';
    }

    public static function success(): self
    {
        return new self('SUCCESS');
    }

    public function isSuccess(): bool
    {
        return $this->status === 'SUCCESS';
    }

    public static function failure(): self
    {
        return new self('FAILURE');
    }

    public function isFailure(): bool
    {
        return $this->status === 'FAILURE';
    }

    public static function timeout(): self
    {
        return new self('TIMEOUT');
    }

    public function isTimeout(): bool
    {
        return $this->status === 'TIMEOUT';
    }

    public function toString(): string
    {
        return $this->status;
    }
}
