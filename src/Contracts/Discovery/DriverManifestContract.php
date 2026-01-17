<?php
declare(strict_types=1);

namespace Dgp\Sdk\Contracts\Discovery;

use Dgp\Sdk\Payloads\Responses\Discovery\GetDriverManifestResponse;
use Dgp\Sdk\Support\Result;

interface DriverManifestContract
{
    /**
     * Describe this driver in a stable, host-readable way.
     *
     * This is how the Host can:
     * - show a provider card (name/version/docs)
     * - understand capabilities without guessing
     * - decide Lane A vs Lane B support
     * - validate runtime config (optional schema)
     *
     * @return Result<GetDriverManifestResponse>
     */
    public function getDriverManifest(): Result;
}