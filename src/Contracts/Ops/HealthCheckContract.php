<?php
declare(strict_types=1);

namespace Dgp\Sdk\Contracts\Ops;

use Dgp\Sdk\Support\Result;
use Dgp\Sdk\Payloads\Requests\Ops\HealthCheckRequest;
use Dgp\Sdk\Payloads\Responses\Ops\HealthCheckResponse;

interface HealthCheckContract
{
    /** @return Result<HealthCheckResponse> */
    public function healthCheck(HealthCheckRequest $request): Result;
}