<?php
declare(strict_types=1);

namespace Dgp\Sdk\Types\Schema\Ui;

final readonly class UiNumber implements UiNode
{
    public function __construct(
        public ?float $minimum = null,
        public ?float $maximum = null,
        public ?float $multipleOf = null,
    ) {}

    public function getType(): string { return 'number'; }

    public function toArray(): array
    {
        return array_filter([
            'type' => $this->getType(),
            'minimum' => $this->minimum,
            'maximum' => $this->maximum,
            'multipleOf' => $this->multipleOf,
        ], static fn ($v) => $v !== null);
    }

    public function jsonSerialize(): array { return $this->toArray(); }
}