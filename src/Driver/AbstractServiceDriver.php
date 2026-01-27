<?php
declare(strict_types=1);

namespace Dgp\Sdk\Driver;

use Throwable;
use Dgp\Sdk\Support\Result;
use Dgp\Sdk\Support\DgpError;
use Dgp\Sdk\Support\DgpErrorCode;
use Dgp\Sdk\Contracts\Ops\HealthCheckContract;
use Dgp\Sdk\Payloads\Requests\Ops\HealthCheckRequest;
use Dgp\Sdk\Payloads\Responses\Ops\HealthCheckResponse;
use Dgp\Sdk\Types\Ops\HealthState;
use Dgp\Sdk\Support\Exceptions\RateLimitedException;
use Timeax\ConfigSchema\Contracts\ProvidesConfigSchema;

abstract readonly class AbstractServiceDriver implements HealthCheckContract, ProvidesConfigSchema
{
    public function __construct(
        protected DriverContext $context,
    )
    {
    }

    protected function ok(mixed $value): Result
    {
        return Result::ok($value);
    }

    protected function fail(DgpError $error): Result
    {
        return Result::fail($error);
    }

    /**
     * Wrap internal exceptions into Result failures.
     * Drivers can still throw internally; Manager/base converts.
     */
    protected function wrap(callable $fn): Result
    {
        try {
            $res = $fn();
            return $res instanceof Result ? $res : Result::fail(DgpError::unknown('Driver returned non-Result'));
        } catch (RateLimitedException $e) {
            return Result::fail(new DgpError(
                DgpErrorCode::RATE_LIMITED,
                $e->getMessage(),
                null,
                null,
                null,
                $e->retryAfterSeconds,
            ));
        } catch (Throwable $e) {
            return Result::fail(DgpError::fromThrowable($e, DgpErrorCode::UNKNOWN));
        }
    }

    public function healthCheck(HealthCheckRequest $request): Result
    {
        return $this->wrap(function () {
            // Default: if we can reach here, we are at least "unknown/ok".
            // Drivers can override for deeper checks.
            return Result::ok(new HealthCheckResponse(HealthState::OK, 'ok'));
        });
    }
}