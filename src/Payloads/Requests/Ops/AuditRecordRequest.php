<?php
declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Requests\Ops;

use JsonSerializable;

final class AuditRecordRequest implements JsonSerializable
{
    /**
     * @param array<string,mixed>|null $payload
     * @param array<string,mixed>|null $meta
     */
    public function __construct(
        public readonly string $stage,     // e.g. "request", "response", "error"
        public readonly string $operation, // e.g. "order.create"
        public readonly ?string $driverKey = null,
        public readonly ?array $payload = null,
        public readonly ?array $meta = null,
    ) {}

    public function jsonSerialize(): array
    {
        return array_filter([
            'stage' => $this->stage,
            'operation' => $this->operation,
            'driverKey' => $this->driverKey,
            'payload' => $this->payload,
            'meta' => $this->meta,
        ], static fn ($v) => $v !== null);
    }
}