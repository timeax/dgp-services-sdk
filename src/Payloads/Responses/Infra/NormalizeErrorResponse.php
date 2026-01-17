<?php
declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Responses\Infra;

use JsonSerializable;
use Dgp\Sdk\Support\DgpError;
use Dgp\Sdk\Types\Infra\ProviderRateLimit;

/**
 * Normalized error result + optional flow-control hints.
 */
final readonly class NormalizeErrorResponse implements JsonSerializable
{
    /**
     * @param array<string,mixed>|null $meta Safe extra info for host analytics/debugging (already redacted)
     */
    public function __construct(
        public DgpError           $error,

        // optional: boundary-level hints
        public ?bool              $retryable = null,
        public ?int               $retryAfterMs = null,
        public ?ProviderRateLimit $rateLimit = null,

        public ?array             $meta = null,
    ) {}

    public function jsonSerialize(): array
    {
        return array_filter([
            'error' => $this->error,
            'retryable' => $this->retryable,
            'retryAfterMs' => $this->retryAfterMs,
            'rateLimit' => $this->rateLimit,
            'meta' => $this->meta,
        ], static fn ($v) => $v !== null);
    }
}