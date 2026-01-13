<?php
declare(strict_types=1);

namespace Dgp\Sdk\Types\Schema;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;

final readonly class ServiceFallback implements Arrayable, JsonSerializable
{
    /**
     * nodes: NodeIdRef(string) -> ServiceIdRef(list)
     * global: ServiceIdRef(string|int as key) -> ServiceIdRef(list)
     *
     * @param array<string, array<int, int|string>>|null $nodes
     * @param array<string, array<int, int|string>>|null $global
     */
    public function __construct(
        public ?array $nodes = null,
        public ?array $global = null,
    ) {}

    public function toArray(): array
    {
        return array_filter([
            'nodes' => $this->nodes,
            'global' => $this->global,
        ], static fn ($v) => $v !== null);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}