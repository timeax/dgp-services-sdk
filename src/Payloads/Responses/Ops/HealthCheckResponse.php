<?php
declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Responses\Ops;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;
use Dgp\Sdk\Types\Ops\HealthState;

final readonly class HealthCheckResponse implements Arrayable, JsonSerializable
{
    /**
     * @param array<string, mixed>|null $meta
     */
    public function __construct(
        public HealthState $state,
        public ?string     $message = null,
        public ?array      $meta = null,
    ) {}

    public function toArray(): array
    {
        return array_filter([
            'state' => $this->state->value,
            'message' => $this->message,
            'meta' => $this->meta,
        ], static fn ($v) => $v !== null);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}