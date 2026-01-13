<?php
declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Requests\Catalog;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;

final readonly class GetOperationInputSchemaRequest implements Arrayable, JsonSerializable
{
    /**
     * @param array<string, mixed>|null $context
     */
    public function __construct(
        public string          $operation,
        public string|int|null $serviceId = null,
        public ?array          $context = null,
    ) {}

    public function toArray(): array
    {
        return array_filter([
            'operation' => $this->operation,
            'service_id' => $this->serviceId,
            'context' => $this->context,
        ], static fn ($v) => $v !== null);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}