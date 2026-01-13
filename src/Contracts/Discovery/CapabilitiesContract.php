<?php
declare(strict_types=1);

namespace Dgp\Sdk\Contracts\Discovery;

use Dgp\Sdk\Support\Result;
use Dgp\Sdk\Payloads\Requests\Discovery\GetCapabilitiesRequest;
use Dgp\Sdk\Payloads\Responses\Discovery\GetCapabilitiesResponse;

interface CapabilitiesContract
{
    /** @return Result<GetCapabilitiesResponse> */
    public function getCapabilities(GetCapabilitiesRequest $request): Result;
}