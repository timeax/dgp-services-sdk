<?php
declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Responses\Discovery;

use JsonSerializable;

final readonly class ResolveProviderServiceResponse implements JsonSerializable
{
    /**
     * @param array<string,mixed>|null $meta
     */
    public function __construct(
        public string|int $providerServiceId,
        public ?string    $variant = null,
        public ?array     $meta = null,
    ) {}

    public function jsonSerialize(): array
    {
        return array_filter([
            'providerServiceId' => $this->providerServiceId,
            'variant' => $this->variant,
            'meta' => $this->meta,
        ], static fn ($v) => $v !== null);
    }
}