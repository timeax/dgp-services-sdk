<?php
declare(strict_types=1);

namespace Dgp\Sdk\Support\Exceptions;

final class RateLimitedException extends DgpException
{
    public function __construct(
        public readonly ?int $retryAfterSeconds = null,
        string $message = 'Rate limited',
        int $code = 0,
        ?\Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}