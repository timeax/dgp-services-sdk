<?php
declare(strict_types=1);

namespace Dgp\Sdk;

use Dgp\Sdk\Contracts\Driver\DriverLinkContract;
use Dgp\Sdk\Driver\DriverContext;
use Dgp\Sdk\Driver\DriverManager;
use Dgp\Sdk\Driver\DriverRegistry;
use Dgp\Sdk\Driver\DriverResolver;
use Dgp\Sdk\Support\Exceptions\DgpException;

final class Dgp
{
    private static ?DriverRegistry $registry = null;
    private static ?DriverManager $manager = null;

    public static function setManager(DriverManager $manager): void
    {
        self::$manager = $manager;
        self::$registry = null;
    }

    public static function setRegistry(DriverRegistry $registry): void
    {
        self::$registry = $registry;
        self::$manager = null;
    }

    public static function registry(): DriverRegistry
    {
        return self::$registry ??= new DriverRegistry();
    }

    public static function manager(): DriverManager
    {
        if (!self::$manager) {
            $resolver = new DriverResolver(self::registry());
            self::$manager = new DriverManager($resolver);
        }
        return self::$manager;
    }

    /**
     * Resolve a driver instance.
     *
     * Supported call forms (2 args max):
     * 1) Link instance: Dgp::via($link)
     * 2) Handler ID:    Dgp::via(12) or Dgp::via('handler_abc')   (must be registered)
     * 3) Driver key:    Dgp::via('justanotherpanel', $context)
     */
    public static function via(string|int|DriverLinkContract $source, ?DriverContext $context = null): object
    {
        // (A) Link instance
        if ($source instanceof DriverLinkContract) {
            if ($context !== null) {
                throw new DgpException(
                    'When passing a DriverLinkContract, do not pass a second argument.'
                );
            }

            $ctx = $source->context();
            $key = self::registry()->normalizeDriverKey($source->driverKey());

            return self::manager()->resolve($key, $ctx);
        }

        // (B) driverKey + context shortcut
        if ($context !== null) {
            $key = self::registry()->normalizeDriverKey((string)$source);
            return self::manager()->resolve($key, $context);
        }

        // (C) handlerId => resolve link from registry => resolve driver
        $link = self::registry()->makeLink($source);

        $ctx = $link->context();
        $key = self::registry()->normalizeDriverKey($link->driverKey());

        return self::manager()->resolve($key, $ctx);
    }

    /** @return string[] */
    public static function drivers(): array
    {
        return self::registry()->keys();
    }
}