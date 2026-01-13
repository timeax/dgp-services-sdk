<?php
declare(strict_types=1);

namespace Dgp\Sdk\Driver;

use Dgp\Sdk\Support\Exceptions\DgpException;

final class DriverRegistry
{
    /** @var array<string, callable(DriverContext): object> */
    private array $factories = [];

    /** @var array<string, array<string, mixed>> */
    private array $meta = [];

    /**
     * @param callable(DriverContext): object $factory
     * @param array<string, mixed> $meta
     */
    public function register(string $key, callable $factory, array $meta = []): void
    {
        if (isset($this->factories[$key])) {
            throw new DgpException("Driver '$key' already registered");
        }

        $this->factories[$key] = $factory;
        $this->meta[$key] = $meta;
    }

    /** @return callable(DriverContext): object */
    public function factory(string $key): callable
    {
        if (!isset($this->factories[$key])) {
            throw new DgpException("Driver '$key' is not registered");
        }

        return $this->factories[$key];
    }

    /** @return array<string, array<string, mixed>> */
    public function metadata(): array
    {
        return $this->meta;
    }

    /** @return string[] */
    public function keys(): array
    {
        return array_keys($this->factories);
    }
}