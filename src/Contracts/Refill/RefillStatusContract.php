<?php
declare(strict_types=1);

namespace Dgp\Sdk\Contracts\Refill;

use Dgp\Sdk\Support\Result;
use Dgp\Sdk\Payloads\Requests\Refill\GetRefillStatusRequest;
use Dgp\Sdk\Payloads\Responses\Refill\GetRefillStatusResponse;

interface RefillStatusContract
{
    /** @return Result<GetRefillStatusResponse> */
    public function getRefillStatus(GetRefillStatusRequest $request): Result;
}