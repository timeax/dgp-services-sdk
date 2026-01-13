<?php
declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Responses\Catalog;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;
use Dgp\Sdk\Types\Schema\ServiceProps;

final readonly class GetServiceSchemaForServiceResponse implements Arrayable, JsonSerializable
{
    public function __construct(
        public string       $serviceId,
        public ServiceProps $schema,
    ) {}

    public function toArray(): array
    {
        return [
            'service_id' => $this->serviceId,
            'schema' => $this->schema->toArray(),
        ];
    }

    public function jsonSerialize(): array { return $this->toArray(); }
}