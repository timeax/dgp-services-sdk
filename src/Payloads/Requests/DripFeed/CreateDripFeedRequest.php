<?php
declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Requests\DripFeed;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;

final readonly class CreateDripFeedRequest implements Arrayable, JsonSerializable
{
    /**
     * @param array<string, mixed> $inputs
     * @param array<string, mixed>|null $meta
     */
    public function __construct(
        public string|int $serviceId,
        public array      $inputs = [],
        public ?array     $meta = null,
    ) {}

    public function toArray(): array
    {
        return array_filter([
            'service_id' => $this->serviceId,
            'inputs' => $this->inputs,
            'meta' => $this->meta,
        ], static fn ($v) => $v !== null);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}