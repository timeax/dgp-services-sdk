<?php
declare(strict_types=1);

namespace Dgp\Sdk\Contracts\Refill;

use Dgp\Sdk\Support\Result;
use Dgp\Sdk\Payloads\Requests\Refill\CreateRefillRequest;
use Dgp\Sdk\Payloads\Responses\Refill\CreateRefillResponse;

interface OrderRefillContract
{
    /** @return Result<CreateRefillResponse> */
    public function createRefill(CreateRefillRequest $request): Result;
}