<?php
declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Requests\Infra;

use JsonSerializable;

final class MakeIdempotencyKeyRequest implements JsonSerializable
{
    /**
     * @param array<string,mixed> $fingerprint Stable input: serviceId/link/quantity/etc.
     * @param array<string,mixed>|null $context
     */
    public function __construct(
        public readonly string $operation,
        public readonly array $fingerprint,
        public readonly ?array $context = null,
    ) {}

    public function jsonSerialize(): array
    {
        return array_filter([
            'operation' => $this->operation,
            'fingerprint' => $this->fingerprint,
            'context' => $this->context,
        ], static fn ($v) => $v !== null);
    }
}