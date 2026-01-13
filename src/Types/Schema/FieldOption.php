<?php
declare(strict_types=1);

namespace Dgp\Sdk\Types\Schema;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;

final readonly class FieldOption implements Arrayable, JsonSerializable
{
    /**
     * @param array<string, mixed>|null $meta
     */
    public function __construct(
        public string          $id,
        public string          $label,
        public string|int|null $value = null,
        public ?int            $serviceId = null,
        public ?string         $pricingRole = null, // "base" | "utility"
        public ?array          $meta = null,
    ) {}

    public function toArray(): array
    {
        return array_filter([
            'id' => $this->id,
            'label' => $this->label,
            'value' => $this->value,
            'service_id' => $this->serviceId,
            'pricing_role' => $this->pricingRole,
            'meta' => $this->meta, // must preserve mixed key style (e.g. quantityDefault)
        ], static fn ($v) => $v !== null);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}