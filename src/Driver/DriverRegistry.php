<?php
declare(strict_types=1);

namespace Dgp\Sdk\Driver;

use Dgp\Sdk\Contracts\Driver\DriverLinkContract;
use Dgp\Sdk\Payloads\Common\DriverRegistration;
use Dgp\Sdk\Support\Exceptions\DgpException;
use Throwable;

final class DriverRegistry
{
    /** @var array<string, callable(DriverContext): object> */
    private array $factories = [];

    /** @var array<string, array<string, mixed>> */
    private array $meta = [];

    /** @var array<string, DriverRegistration> normalized handlerId => registration */
    private array $handlers = [];

    /**
     * Register a driver factory.
     *
     * @param callable(DriverContext): object $factory
     * @param array<string,mixed> $meta
     */
    public function registerDriver(string $driverKey, callable $factory, array $meta = []): void
    {
        $driverKey = $this->normalizeDriverKey($driverKey);

        if (isset($this->factories[$driverKey])) {
            throw new DgpException("Driver '$driverKey' already registered");
        }

        $this->factories[$driverKey] = $factory;
        $this->meta[$driverKey] = $meta;
    }

    /**
     * Register a handler entry (host-stored mapping).
     */
    public function registerHandler(DriverRegistration $registration): void
    {
        $driverKey = $this->normalizeDriverKey($registration->driverKey);

        if (!isset($this->factories[$driverKey])) {
            throw new DgpException("Cannot register handler: driver '$driverKey' is not registered.");
        }

        $linkClass = trim($registration->linkClass);

        if ($linkClass === '' || !class_exists($linkClass)) {
            throw new DgpException("DriverLink class '$linkClass' does not exist.");
        }

        if (!is_subclass_of($linkClass, DriverLinkContract::class)) {
            throw new DgpException("DriverLink class '$linkClass' must implement " . DriverLinkContract::class);
        }

        $k = $this->normalizeHandlerId($registration->handlerId);

        $this->handlers[$k] = new DriverRegistration(
            handlerId: $registration->handlerId,
            driverKey: $driverKey,
            linkClass: $linkClass,
            meta: $registration->meta,
        );
    }

    /** @return callable(DriverContext): object */
    public function factory(string $driverKey): callable
    {
        $driverKey = $this->normalizeDriverKey($driverKey);

        if (!isset($this->factories[$driverKey])) {
            throw new DgpException("Driver '$driverKey' is not registered");
        }

        return $this->factories[$driverKey];
    }

    public function hasDriver(string $driverKey): bool
    {
        return isset($this->factories[$this->normalizeDriverKey($driverKey)]);
    }

    public function getHandler(int|string $handlerId): ?DriverRegistration
    {
        return $this->handlers[$this->normalizeHandlerId($handlerId)] ?? null;
    }

    public function hasHandler(int|string $handlerId): bool
    {
        return isset($this->handlers[$this->normalizeHandlerId($handlerId)]);
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

    public function normalizeDriverKey(string $driverKey): string
    {
        $driverKey = trim($driverKey);
        if ($driverKey === '') {
            throw new DgpException('Driver key cannot be empty.');
        }
        return $driverKey;
    }

    private function normalizeHandlerId(int|string $id): string
    {
        return is_int($id) ? 'i:' . $id : 's:' . $id;
    }

    /**
     * Instantiate the link for a handlerId (PayKit-style provider instantiation).
     */
    public function makeLink(int|string $handlerId): DriverLinkContract
    {
        $reg = $this->getHandler($handlerId);

        if (!$reg) {
            throw new DgpException("Handler '$handlerId' is not registered in the DriverRegistry.");
        }

        $cls = $reg->linkClass;

        try {
            /** @var DriverLinkContract $link */
            $link = new $cls($handlerId);
            return $link;
        } catch (Throwable $e) {
            throw new DgpException(
                "Failed to instantiate DriverLink '$cls' for handler '$handlerId': {$e->getMessage()}",
                previous: $e
            );
        }
    }
}