<?php
declare(strict_types=1);

namespace Dgp\Sdk\Contracts\Infra;

use Dgp\Sdk\Support\Result;
use Dgp\Sdk\Payloads\Requests\Infra\AuthApplyRequest;

interface AuthStrategyContract
{
    /**
     * Apply driver/provider authentication to an outbound request.
     *
     * Typical outcomes:
     * - add headers (Authorization, X-Api-Key, etc.)
     * - add query params (key=...)
     * - add signatures
     *
     * @return Result<\Dgp\Sdk\Payloads\Responses\Infra\AuthApplyResponse>
     */
    public function applyAuth(AuthApplyRequest $request): Result;
}