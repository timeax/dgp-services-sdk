<?php
declare(strict_types=1);

namespace Dgp\Sdk\Types\Driver;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;
use Dgp\Sdk\Support\Serialization\Normalizes;

final class ConfigFieldOption implements Arrayable, JsonSerializable
{
    use Normalizes;

    /**
     * @param array<string,mixed>|null $meta
     */
    public function __construct(
        public readonly string               $id,
        public readonly string               $label,
        public readonly string|int|bool|null $value = null,
        public readonly ?bool                $disabled = null,
        public readonly ?array               $meta = null,
    )
    {
    }

    public function toArray(): array
    {
        return $this->normalize([
            'id' => $this->id,
            'label' => $this->label,
            'value' => $this->value,
            'disabled' => $this->disabled,
            'meta' => $this->meta,
        ]);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}