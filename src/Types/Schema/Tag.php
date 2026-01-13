<?php
declare(strict_types=1);

namespace Dgp\Sdk\Types\Schema;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;

final readonly class Tag implements Arrayable, JsonSerializable
{
    /**
     * @param string[]|null $includes
     * @param string[]|null $excludes
     * @param array<string, mixed>|null $meta
     * @param array<string, bool>|null $constraints
     * @param array<string, string>|null $constraintsOrigin
     * @param array<string, ConstraintOverride>|null $constraintsOverrides
     */
    public function __construct(
        public string  $id,
        public string  $label,
        public ?string $bindId = null,
        public ?int    $serviceId = null,

        public ?array  $includes = null,
        public ?array  $excludes = null,

        public ?array  $meta = null,

        public ?array  $constraints = null,
        public ?array  $constraintsOrigin = null,
        public ?array  $constraintsOverrides = null,
    ) {}

    public function toArray(): array
    {
        $overrides = null;
        if ($this->constraintsOverrides !== null) {
            $overrides = [];
            foreach ($this->constraintsOverrides as $k => $v) {
                $overrides[$k] = $v->toArray();
            }
        }

        return array_filter([
            'id' => $this->id,
            'label' => $this->label,
            'bind_id' => $this->bindId,
            'service_id' => $this->serviceId,
            'includes' => $this->includes,
            'excludes' => $this->excludes,
            'meta' => $this->meta,
            'constraints' => $this->constraints,
            'constraints_origin' => $this->constraintsOrigin,
            'constraints_overrides' => $overrides,
        ], static fn ($v) => $v !== null);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}