<?php

declare(strict_types=1);

namespace Tests;

use DateInterval;
use Psr\SimpleCache\CacheInterface;
use RuntimeException;

final class FakeSimpleCache implements CacheInterface
{
    public array $cache = [];

    public function get(string $key, mixed $default = null): mixed
    {
        return $this->cache[$key] ?? $default;
    }

    public function set(string $key, mixed $value, DateInterval|int|null $ttl = null): bool
    {
        $this->cache[$key] = $value;

        return true;
    }

    public function delete(string $key): bool
    {
        throw new RuntimeException('Not implemented');
    }

    public function clear(): bool
    {
        throw new RuntimeException('Not implemented');
    }

    public function getMultiple(iterable $keys, mixed $default = null): iterable
    {
        throw new RuntimeException('Not implemented');
    }

    public function setMultiple(iterable $values, DateInterval|int|null $ttl = null): bool
    {
        throw new RuntimeException('Not implemented');
    }

    public function deleteMultiple(iterable $keys): bool
    {
        throw new RuntimeException('Not implemented');
    }

    public function has(string $key): bool
    {
        return isset($this->cache[$key]);
    }
}
