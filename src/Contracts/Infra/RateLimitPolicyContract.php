<?php
declare(strict_types=1);

namespace Dgp\Sdk\Contracts\Infra;

use Dgp\Sdk\Support\Result;
use Dgp\Sdk\Payloads\Requests\Infra\RateLimitHintRequest;

interface RateLimitPolicyContract
{
    /**
     * Extract/derive rate-limit hints (cooldowns, windows, remaining tokens).
     * Used by host schedulers/queues to behave smarter.
     *
     * @return Result<\Dgp\Sdk\Payloads\Responses\Infra\RateLimitHintResponse>
     */
    public function getRateLimitHint(RateLimitHintRequest $request): Result;
}