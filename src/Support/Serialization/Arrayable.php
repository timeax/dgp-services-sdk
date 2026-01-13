<?php
declare(strict_types=1);

namespace Dgp\Sdk\Support\Serialization;

interface Arrayable
{
    /** @return array<string, mixed> */
    public function toArray(): array;
}