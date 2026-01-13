<?php
declare(strict_types=1);

namespace Dgp\Sdk\Types;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;

final readonly class Currency implements Arrayable, JsonSerializable
{
    public function __construct(
        public string $code,      // e.g. "USD"
        public int    $decimals = 2,  // 2 for USD, 0 for JPY etc
    )
    {
    }

    public function toArray(): array
    {
        return [
            'code' => $this->code,
            'decimals' => $this->decimals,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}