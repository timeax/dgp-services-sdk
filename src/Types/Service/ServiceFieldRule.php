<?php
declare(strict_types=1);

namespace Dgp\Sdk\Types\Service;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;

final readonly class ServiceFieldRule implements Arrayable, JsonSerializable
{
    /**
     * @param string $rule
     * @param mixed $value
     */
    public function __construct(
        public string $rule,   // e.g. "required", "url", "min", "max", "regex"
        public mixed  $value = true,
    )
    {
    }

    public function toArray(): array
    {
        return [
            'rule' => $this->rule,
            'value' => $this->value,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}