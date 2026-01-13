<?php
declare(strict_types=1);

namespace Dgp\Sdk\Types\Schema;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;
use Dgp\Sdk\Types\Schema\Ui\UiNode;

final readonly class Field implements Arrayable, JsonSerializable
{
    /**
     * @param array<string, UiNode>|null $ui
     * @param array<string, mixed>|null $defaults
     * @param FieldOption[]|null $options
     * @param array<string, mixed>|null $meta
     */
    public function __construct(
        public string            $id,
        public string            $type,                 // "custom" | string
        public string            $label,

        public ?string           $name = null,
        public ?bool             $required = null,

        public ?array            $ui = null,
        public ?array            $defaults = null,

        public string|array|null $bindId = null,
        public ?array            $options = null,

        public ?string           $component = null,    // required if type === "custom"
        public ?string           $pricingRole = null,  // "base" | "utility" (JSON key: pricing_role)
        public ?array            $meta = null,

        public ?bool             $button = null,
        public ?int              $serviceId = null,
    ) {}

    public function toArray(): array
    {
        $uiOut = null;
        if ($this->ui !== null) {
            $uiOut = [];
            foreach ($this->ui as $k => $v) {
                $uiOut[$k] = $v->toArray();
            }
        }

        $optOut = null;
        if ($this->options !== null) {
            $optOut = array_map(static fn (FieldOption $o) => $o->toArray(), $this->options);
        }

        return array_filter([
            'id' => $this->id,
            'type' => $this->type,
            'label' => $this->label,

            'name' => $this->name,
            'required' => $this->required,

            'ui' => $uiOut,
            'defaults' => $this->defaults,

            'bind_id' => $this->bindId,
            'options' => $optOut,

            'component' => $this->component,
            'pricing_role' => $this->pricingRole, // snake_case key enforced
            'meta' => $this->meta,                // must preserve mixed meta keys

            'button' => $this->button,
            'service_id' => $this->serviceId,
        ], static fn ($v) => $v !== null);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}