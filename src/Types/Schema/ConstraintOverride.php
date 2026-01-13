<?php
declare(strict_types=1);

namespace Dgp\Sdk\Types\Schema;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;

final readonly class ConstraintOverride implements Arrayable, JsonSerializable
{
    public function __construct(
        public bool   $from,
        public bool   $to,
        public string $origin, // tagId
    ) {}

    public function toArray(): array
    {
        return [
            'from' => $this->from,
            'to' => $this->to,
            'origin' => $this->origin,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}