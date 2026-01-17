<?php
declare(strict_types=1);

namespace Dgp\Sdk\Types\Driver;

use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;
use Dgp\Sdk\Support\Serialization\Normalizes;

final class DriverConfigSchema implements Arrayable, JsonSerializable
{
    use Normalizes;

    /**
     * @param list<ConfigField> $fields
     * @param array<string,mixed>|null $meta
     */
    public function __construct(
        public readonly array   $fields,
        public readonly ?string $schema_version = null,
        public readonly ?array  $meta = null,
    )
    {
    }

    /** @return list<string> */
    public function keysForSandbox(bool $sandbox): array
    {
        $out = [];

        foreach ($this->fields as $f) {
            if ($f->sandbox === null || $f->sandbox === $sandbox) {
                $out[] = $f->name;
            }
        }

        $out = array_values(array_unique($out));
        sort($out);

        return $out;
    }

    public function toArray(): array
    {
        return $this->normalize([
            'schema_version' => $this->schema_version,
            'fields' => $this->fields,
            'meta' => $this->meta,
        ]);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}