<?php
declare(strict_types=1);

namespace Dgp\Sdk\Types\Service;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;

final readonly class ServiceDefinition implements Arrayable, JsonSerializable
{
    /**
     * @param array<string, mixed>|null $meta
     */
    public function __construct(
        public string            $id,          // provider service id
        public string            $name,
        public float             $rate,         // keep as float for now (provider-centric); host can convert to Money
        public int               $min,
        public int               $max,
        public string            $category,
        public ?ServiceFlagset   $flags = new ServiceFlagset([], true),

        public ?ServiceEstimates $estimates = null,

        public ?array            $meta = null, // provider extras (bag)
    )
    {
    }

    public function toArray(): array
    {
        return array_filter([
            'id' => $this->id,
            'name' => $this->name,
            'rate' => $this->rate,
            'min' => $this->min,
            'max' => $this->max,
            'category' => $this->category,
            'flags' => $this->flags?->toArray(),
            'estimates' => $this->estimates?->toArray(),
            'meta' => $this->meta,
        ], static fn($v) => $v !== null);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}