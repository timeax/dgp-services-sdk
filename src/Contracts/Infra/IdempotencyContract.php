<?php
declare(strict_types=1);

namespace Dgp\Sdk\Contracts\Infra;

use Dgp\Sdk\Support\Result;
use Dgp\Sdk\Payloads\Requests\Infra\MakeIdempotencyKeyRequest;

interface IdempotencyContract
{
    /**
     * Create an idempotency key for a request fingerprint.
     *
     * @return Result<\Dgp\Sdk\Payloads\Responses\Infra\MakeIdempotencyKeyResponse>
     */
    public function makeIdempotencyKey(MakeIdempotencyKeyRequest $request): Result;
}