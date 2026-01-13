<?php
declare(strict_types=1);

namespace Dgp\Sdk\Types\Schema\Ui;

final readonly class UiString implements UiNode
{
    /**
     * @param string[]|null $enum
     */
    public function __construct(
        public ?array  $enum = null,
        public ?int    $minLength = null,
        public ?int    $maxLength = null,
        public ?string $pattern = null,
        public ?string $format = null,
    ) {}

    public function getType(): string { return 'string'; }

    public function toArray(): array
    {
        return array_filter([
            'type' => $this->getType(),
            'enum' => $this->enum,
            'minLength' => $this->minLength,
            'maxLength' => $this->maxLength,
            'pattern' => $this->pattern,
            'format' => $this->format,
        ], static fn ($v) => $v !== null);
    }

    public function jsonSerialize(): array { return $this->toArray(); }
}