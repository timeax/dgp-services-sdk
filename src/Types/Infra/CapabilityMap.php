<?php
declare(strict_types=1);

namespace Dgp\Sdk\Types\Infra;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;

final readonly class CapabilityMap implements Arrayable, JsonSerializable
{
    /** @param array<string, bool> $map */
    public function __construct(
        public array $map = [],
    )
    {
    }

    public function has(string $capability): bool
    {
        return (bool)($this->map[$capability] ?? false);
    }

    public function with(string $capability, bool $enabled = true): self
    {
        $next = $this->map;
        $next[$capability] = $enabled;
        return new self($next);
    }

    public function toArray(): array
    {
        return $this->map;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}