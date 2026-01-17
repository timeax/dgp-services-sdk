<?php
declare(strict_types=1);

namespace Dgp\Sdk\Types\Ops;

use JsonSerializable;

final readonly class WebhookEvent implements JsonSerializable
{
    /**
     * @param array<string,mixed>|null $data
     * @param array<string,mixed>|null $meta
     */
    public function __construct(
        public string  $type,
        public ?string $providerEventId = null,
        public ?int    $occurredAtUnixMs = null,
        public ?array  $data = null,
        public ?array  $meta = null,
    ) {}

    public function jsonSerialize(): array
    {
        return array_filter([
            'type' => $this->type,
            'providerEventId' => $this->providerEventId,
            'occurredAtUnixMs' => $this->occurredAtUnixMs,
            'data' => $this->data,
            'meta' => $this->meta,
        ], static fn ($v) => $v !== null);
    }
}