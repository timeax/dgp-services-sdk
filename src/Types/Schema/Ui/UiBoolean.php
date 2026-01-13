<?php
declare(strict_types=1);

namespace Dgp\Sdk\Types\Schema\Ui;

final class UiBoolean implements UiNode
{
    public function getType(): string { return 'boolean'; }

    public function toArray(): array
    {
        return ['type' => $this->getType()];
    }

    public function jsonSerialize(): array { return $this->toArray(); }
}