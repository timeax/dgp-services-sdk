<?php
declare(strict_types=1);

namespace Dgp\Sdk\Contracts\Infra;

use Dgp\Sdk\Support\DgpError;

interface ErrorNormalizerContract
{
    /**
     * Normalize any provider error shape into a canonical DgpError.
     * This is intentionally not Result-wrapped: it’s a pure mapping function.
     */
    public function normalize(mixed $raw, ?int $httpStatus = null): DgpError;
}