<?php
declare(strict_types=1);

namespace Dgp\Sdk\Types\Schema\Ui;

final readonly class UiObject implements UiNode
{
    /**
     * @param array<string, UiNode> $fields
     * @param string[]|null $required
     * @param string[]|null $order
     */
    public function __construct(
        public array  $fields,
        public ?array $required = null,
        public ?array $order = null,
    ) {}

    public function getType(): string { return 'object'; }

    public function toArray(): array
    {
        $outFields = [];
        foreach ($this->fields as $k => $v) {
            $outFields[$k] = $v->toArray();
        }

        return array_filter([
            'type' => $this->getType(),
            'fields' => $outFields,
            'required' => $this->required,
            'order' => $this->order,
        ], static fn ($v) => $v !== null);
    }

    public function jsonSerialize(): array { return $this->toArray(); }
}