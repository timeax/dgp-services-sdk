<?php
declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Responses\Catalog;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;
use Dgp\Sdk\Types\Service\ServiceInputSchema;

final readonly class GetServiceInputSchemaResponse implements Arrayable, JsonSerializable
{
    public function __construct(
        public ServiceInputSchema $schema,
    ) {}

    public function toArray(): array
    {
        return [
            'schema' => $this->schema->toArray(),
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}