<?php
declare(strict_types=1);

namespace Dgp\Sdk\Contracts\Infra;

use Dgp\Sdk\Support\Result;
use Dgp\Sdk\Payloads\Requests\Infra\RetryDecisionRequest;

interface RetryPolicyContract
{
    /**
     * Decide whether a failed operation should be retried, and with what delay.
     *
     * Business failures usually return Result::fail(...) and do NOT retry.
     * Transport/system failures may be retryable depending on policy.
     *
     * @return Result<\Dgp\Sdk\Payloads\Responses\Infra\RetryDecisionResponse>
     */
    public function decideRetry(RetryDecisionRequest $request): Result;
}