<?php
declare(strict_types=1);

namespace Dgp\Sdk\Types\Schema\Ui;

final readonly class UiArray implements UiNode
{
    /**
     * @param UiNode[]|null $items
     */
    public function __construct(
        public ?UiNode $item = null,
        public ?array  $items = null,
        public ?int    $minItems = null,
        public ?int    $maxItems = null,
        public ?bool   $uniqueItems = null,
    ) {}

    public function getType(): string { return 'array'; }

    public function toArray(): array
    {
        $tuple = null;
        if ($this->items !== null) {
            $tuple = array_map(static fn (UiNode $n) => $n->toArray(), $this->items);
        }

        return array_filter([
            'type' => $this->getType(),
            'item' => $this->item?->toArray(),
            'items' => $tuple,
            'minItems' => $this->minItems,
            'maxItems' => $this->maxItems,
            'uniqueItems' => $this->uniqueItems,
        ], static fn ($v) => $v !== null);
    }

    public function jsonSerialize(): array { return $this->toArray(); }
}