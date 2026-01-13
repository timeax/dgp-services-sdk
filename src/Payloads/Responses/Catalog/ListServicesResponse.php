<?php
declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Responses\Catalog;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;
use Dgp\Sdk\Types\Service\ServiceDefinition;

final readonly class ListServicesResponse implements Arrayable, JsonSerializable
{
    /**
     * @param ServiceDefinition[] $services
     */
    public function __construct(
        public array   $services,
        public ?string $nextCursor = null,
    ) {}

    public function toArray(): array
    {
        return array_filter([
            'services' => array_map(static fn (ServiceDefinition $s) => $s->toArray(), $this->services),
            'next_cursor' => $this->nextCursor,
        ], static fn ($v) => $v !== null);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}