<?php
declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Responses\Infra;

use JsonSerializable;

final class RetryDecisionResponse implements JsonSerializable
{
    public function __construct(
        public readonly bool $shouldRetry,
        public readonly ?int $delayMs = null,
        public readonly ?string $reason = null,
    ) {}

    public function jsonSerialize(): array
    {
        return array_filter([
            'shouldRetry' => $this->shouldRetry,
            'delayMs' => $this->delayMs,
            'reason' => $this->reason,
        ], static fn ($v) => $v !== null);
    }
}