<?php
declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Responses\Catalog;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;
use Dgp\Sdk\Types\Service\ServiceInputSchema;

final readonly class GetOperationInputSchemaResponse implements Arrayable, JsonSerializable
{
    /**
     * @param array<string, mixed>|null $meta
     */
    public function __construct(
        public string             $operation,
        public ServiceInputSchema $schema,
        public string|int|null    $serviceId = null,
        public ?string            $schemaVersion = null,
        public ?array             $meta = null,
    )
    {
    }

    public function toArray(): array
    {
        return array_filter([
            'operation' => $this->operation,
            'service_id' => $this->serviceId,
            'schema_version' => $this->schemaVersion,
            'schema' => $this->schema->toArray(),
            'meta' => $this->meta,
        ], static fn($v) => $v !== null);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}