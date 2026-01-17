<?php
declare(strict_types=1);

namespace Dgp\Sdk\Types\Infra;

use JsonSerializable;

final readonly class ProviderRateLimitWindow implements JsonSerializable
{
    public function __construct(
        public int  $windowMs,
        public ?int $resetAtUnixMs = null,
    ) {}

    public function jsonSerialize(): array
    {
        return array_filter([
            'windowMs' => $this->windowMs,
            'resetAtUnixMs' => $this->resetAtUnixMs,
        ], static fn ($v) => $v !== null);
    }
}