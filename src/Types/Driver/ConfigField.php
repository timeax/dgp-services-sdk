<?php declare(strict_types=1);

namespace Dgp\Sdk\Types\Driver;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;
use Dgp\Sdk\Support\Serialization\Normalizes;

final class ConfigField implements Arrayable, JsonSerializable
{
    use Normalizes;

    /**
     * @param list<string>|null $rules
     * @param list<ConfigFieldOption>|null $options
     * @param array<string,mixed>|null $meta
     */
    public function __construct(
        public readonly string  $name,
        public readonly string  $label,
        public readonly ?string $type = null,        // "text"|"password"|"select"|...

        public readonly ?bool   $required = null,
        public readonly ?bool   $secret = null,

        // ✅ NEW: mode scoping (null=both, true=sandbox-only, false=live-only)
        public readonly ?bool   $sandbox = null,

        public readonly ?array  $rules = null,
        public readonly mixed   $default = null,
        public readonly ?string $help_text = null,
        public readonly ?array  $options = null,
        public readonly ?array  $meta = null,
    )
    {
    }

    public function toArray(): array
    {
        return $this->normalize([
            'name' => $this->name,
            'label' => $this->label,
            'type' => $this->type,
            'required' => $this->required,
            'secret' => $this->secret,
            'sandbox' => $this->sandbox, // ✅ include so host UI/storage can scope
            'rules' => $this->rules,
            'default' => $this->default,
            'help_text' => $this->help_text,
            'options' => $this->options,
            'meta' => $this->meta,
        ]);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}