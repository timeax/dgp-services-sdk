<?php
declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Requests\Catalog;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;

final readonly class GetServiceSchemaSnapshotRequest implements Arrayable, JsonSerializable
{
    /**
     * @param array<string, mixed>|null $context
     */
    public function __construct(
        public ?array $context = null,
    ) {}

    public function toArray(): array
    {
        return array_filter([
            'context' => $this->context,
        ], static fn ($v) => $v !== null);
    }

    public function jsonSerialize(): array { return $this->toArray(); }
}