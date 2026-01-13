<?php
declare(strict_types=1);

namespace Dgp\Sdk\Driver;

use Throwable;
use Dgp\Sdk\Support\Result;
use Dgp\Sdk\Support\DgpError;
use Dgp\Sdk\Support\DgpErrorCode;
use Dgp\Sdk\Support\Exceptions\RateLimitedException;
use Dgp\Sdk\Support\Exceptions\ValidationException;

final readonly class DriverManager
{
    public function __construct(
        private DriverResolver $resolver,
    ) {}

    public function resolve(string $key, DriverContext $context): object
    {
        return $this->resolver->resolve($key, $context);
    }

    /**
     * Boundary wrapper:
     * - expected business failures should be returned as Result::fail(DgpError)
     * - exceptions are internal/system/invariant and are converted here
     *
     * @template T
     * @param callable(): Result $fn
     * @return Result
     */
    public function call(callable $fn): Result
    {
        try {
            $res = $fn();

            // If someone returns something invalid, normalize to unknown.
            if (!$res instanceof Result) {
                return Result::fail(DgpError::unknown('Driver returned non-Result'));
            }

            return $res;
        } catch (RateLimitedException $e) {
            return Result::fail(new DgpError(
                DgpErrorCode::RATE_LIMITED,
                $e->getMessage(),
                null,
                null,
                null,
                $e->retryAfterSeconds,
            ));
        } catch (ValidationException $e) {
            return Result::fail(DgpError::fromThrowable($e, DgpErrorCode::VALIDATION_FAILED));
        } catch (Throwable $e) {
            return Result::fail(DgpError::fromThrowable($e, DgpErrorCode::UNKNOWN));
        }
    }
}