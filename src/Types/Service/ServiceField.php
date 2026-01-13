<?php
declare(strict_types=1);

namespace Dgp\Sdk\Types\Service;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;

final readonly class ServiceField implements Arrayable, JsonSerializable
{
    /**
     * @param ServiceFieldRule[] $rules
     * @param array<string, mixed>|null $meta
     */
    public function __construct(
        public string $key,      // e.g. "link", "quantity", "username"
        public string $label,
        public string $type,     // e.g. "string", "number", "text", "url"
        public bool   $required = false,
        public array  $rules = [],
        public ?array $meta = null,
    ) {}

    public function toArray(): array
    {
        return array_filter([
            'key' => $this->key,
            'label' => $this->label,
            'type' => $this->type,
            'required' => $this->required,
            'rules' => array_map(static fn (ServiceFieldRule $r) => $r->toArray(), $this->rules),
            'meta' => $this->meta,
        ], static fn ($v) => $v !== null);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}