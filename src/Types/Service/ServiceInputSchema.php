<?php
declare(strict_types=1);

namespace Dgp\Sdk\Types\Service;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;

final readonly class ServiceInputSchema implements Arrayable, JsonSerializable
{
    /**
     * @param ServiceField[] $fields
     * @param array<string, mixed>|null $meta
     */
    public function __construct(
        public string $serviceId,  // provider service id
        public array  $fields = [],
        public ?array $meta = null,
    )
    {
    }

    public function toArray(): array
    {
        return array_filter([
            'service_id' => $this->serviceId,
            'fields' => array_map(static fn(ServiceField $f) => $f->toArray(), $this->fields),
            'meta' => $this->meta,
        ], static fn($v) => $v !== null);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}