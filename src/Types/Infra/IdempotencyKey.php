<?php
declare(strict_types=1);

namespace Dgp\Sdk\Types\Infra;

use JsonSerializable;

final readonly class IdempotencyKey implements JsonSerializable
{
    public function __construct(public string $value) {}

    public function jsonSerialize(): array
    {
        return ['value' => $this->value];
    }
}