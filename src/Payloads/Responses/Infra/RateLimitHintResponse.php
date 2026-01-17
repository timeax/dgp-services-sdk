<?php
declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Responses\Infra;

use JsonSerializable;
use Dgp\Sdk\Types\Infra\ProviderRateLimit;

final class RateLimitHintResponse implements JsonSerializable
{
    public function __construct(
        public readonly ?ProviderRateLimit $rateLimit = null,
        public readonly ?int $cooldownMs = null,
        public readonly ?string $note = null,
    ) {}

    public function jsonSerialize(): array
    {
        return array_filter([
            'rateLimit' => $this->rateLimit,
            'cooldownMs' => $this->cooldownMs,
            'note' => $this->note,
        ], static fn ($v) => $v !== null);
    }
}