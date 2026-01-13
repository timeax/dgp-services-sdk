<?php
declare(strict_types=1);

namespace Dgp\Sdk\Types\Schema\Ui;

final readonly class UiAnyOf implements UiNode
{
    /**
     * @param array<int, array{type: 'string'|'number'|'boolean', value: string|int|float|bool, title?: string, description?: string}> $items
     */
    public function __construct(
        public array $items,
        public ?bool $multiple = null,
    ) {}

    public function getType(): string { return 'anyOf'; }

    public function toArray(): array
    {
        return array_filter([
            'type' => $this->getType(),
            'multiple' => $this->multiple,
            'items' => $this->items,
        ], static fn ($v) => $v !== null);
    }

    public function jsonSerialize(): array { return $this->toArray(); }
}