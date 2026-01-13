<?php
declare(strict_types=1);

namespace Dgp\Sdk\Types\Schema\Ui;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;

interface UiNode extends Arrayable, JsonSerializable
{
    public function getType(): string;
}