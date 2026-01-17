<?php
declare(strict_types=1);

namespace Dgp\Sdk\Contracts\Infra;

use Dgp\Sdk\Support\Result;
use Dgp\Sdk\Payloads\Requests\Infra\NormalizeErrorRequest;

interface ErrorNormalizerContract
{
    /**
     * Normalize any provider/system failure shape into a canonical DgpError.
     *
     * This is the main “quirk absorber”:
     * - HTTP 200 with {"error":true}
     * - HTTP 400 with {"msg":"bad"}
     * - transport exceptions
     * - inconsistent provider codes/messages
     *
     * @return Result<\Dgp\Sdk\Payloads\Responses\Infra\NormalizeErrorResponse>
     */
    public function normalizeError(NormalizeErrorRequest $request): Result;
}