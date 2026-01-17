<?php
declare(strict_types=1);

namespace Dgp\Sdk\Types\Infra;

use JsonSerializable;

final readonly class ProviderRateLimit implements JsonSerializable
{
    public function __construct(
        public ?int                     $limit = null,
        public ?int                     $remaining = null,
        public ?int                     $retryAfterMs = null,
        public ?ProviderRateLimitWindow $window = null,
    ) {}

    public function jsonSerialize(): array
    {
        return array_filter([
            'limit' => $this->limit,
            'remaining' => $this->remaining,
            'retryAfterMs' => $this->retryAfterMs,
            'window' => $this->window,
        ], static fn ($v) => $v !== null);
    }
}