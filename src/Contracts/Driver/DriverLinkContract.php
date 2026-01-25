<?php
declare(strict_types=1);

namespace Dgp\Sdk\Contracts\Driver;

use Dgp\Sdk\Driver\DriverContext;

/**
 * Host adapter that links a stored handler entry (e.g. dgp_handler row)
 * to a driverKey + fully-built DriverContext.
 *
 * Similar to PayKit\ProvidesGatewayConfigContract, but for DGP providers.
 */
interface DriverLinkContract
{
    public function driverKey(): string;

    public function context(): DriverContext;
}