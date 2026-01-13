<?php
declare(strict_types=1);

namespace Dgp\Sdk\Types\Schema;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;

final readonly class ServiceProps implements Arrayable, JsonSerializable
{
    /**
     * @param array<string, string[]>|null $orderForTags
     * @param Tag[] $filters
     * @param Field[] $fields
     * @param array<string, string[]>|null $includesForButtons
     * @param array<string, string[]>|null $excludesForButtons
     */
    public function __construct(
        public array            $filters,
        public array            $fields,

        public ?array           $orderForTags = null,
        public ?array           $includesForButtons = null,
        public ?array           $excludesForButtons = null,

        public ?string          $schemaVersion = null,
        public ?ServiceFallback $fallbacks = null,
    ) {}

    public function toArray(): array
    {
        return array_filter([
            'order_for_tags' => $this->orderForTags,
            'filters' => array_map(static fn (Tag $t) => $t->toArray(), $this->filters),
            'fields' => array_map(static fn (Field $f) => $f->toArray(), $this->fields),
            'includes_for_buttons' => $this->includesForButtons,
            'excludes_for_buttons' => $this->excludesForButtons,
            'schema_version' => $this->schemaVersion,
            'fallbacks' => $this->fallbacks?->toArray(),
        ], static fn ($v) => $v !== null);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}