<?php
declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Requests\Discovery;

use JsonSerializable;

final readonly class ResolveProviderServiceRequest implements JsonSerializable
{
    /**
     * @param array<string,mixed>|null $context
     */
    public function __construct(
        public string|int $internalServiceId,
        public ?array     $context = null,
    ) {}

    public function jsonSerialize(): array
    {
        return array_filter([
            'internalServiceId' => $this->internalServiceId,
            'context' => $this->context,
        ], static fn ($v) => $v !== null);
    }
}