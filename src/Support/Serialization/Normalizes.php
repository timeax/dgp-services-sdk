<?php
declare(strict_types=1);

namespace Dgp\Sdk\Support\Serialization;

use BackedEnum;
use DateTimeInterface;
use JsonSerializable;
use UnitEnum;

/**
 * Helper trait for building stable, explicit serialization arrays.
 *
 * Usage:
 *   public function jsonSerialize(): array
 *   {
 *       return $this->normalize([
 *           'id' => $this->id,
 *           'pricing_role' => $this->pricingRole,
 *           'quantityDefault' => $this->quantityDefault,
 *           'schema' => $this->schema, // Arrayable/JsonSerializable supported
 *       ]);
 *   }
 *
 * NOTE:
 * - This does NOT auto-convert key casing. You must explicitly output the keys your frontend expects.
 * - It only normalizes VALUES (nested DTOs, enums, dates, arrays) and removes nulls.
 */
trait Normalizes
{
    /**
     * Normalize an associative array:
     * - recursively normalizes values
     * - removes null values (but keeps false/0/''/[])
     *
     * @param array<string|int, mixed> $data
     * @return array<string|int, mixed>
     */
    protected function normalize(array $data): array
    {
        $out = [];

        foreach ($data as $k => $v) {
            $out[$k] = $this->normalizeValue($v);
        }

        return $this->withoutNulls($out);
    }

    /**
     * Remove ONLY null values (preserve false/0/''/[]).
     *
     * @param array<string|int, mixed> $data
     * @return array<string|int, mixed>
     */
    protected function withoutNulls(array $data): array
    {
        return array_filter($data, static fn($v) => $v !== null);
    }

    /**
     * Normalize a single value for safe JSON output.
     */
    protected function normalizeValue(mixed $value): mixed
    {
        if ($value === null) {
            return null;
        }

        // Arrays: normalize recursively
        if (is_array($value)) {
            return $this->normalizeArray($value);
        }

        // Prefer Arrayable over JsonSerializable
        if ($value instanceof Arrayable) {
            return $this->normalizeArray($value->toArray());
        }

        if ($value instanceof JsonSerializable) {
            $serialized = $value->jsonSerialize();
            return is_array($serialized) ? $this->normalizeArray($serialized) : $serialized;
        }

        // Dates: ISO-8601
        if ($value instanceof DateTimeInterface) {
            return $value->format(DATE_ATOM);
        }

        // Enums: backing value if available, else name
        if ($value instanceof BackedEnum) {
            return $value->value;
        }
        if ($value instanceof UnitEnum) {
            return $value->name;
        }

        // Scalars & objects with __toString
        if (is_scalar($value)) {
            return $value;
        }

        if (is_object($value) && method_exists($value, '__toString')) {
            return (string)$value;
        }

        // Fallback: keep as-is (host/driver may choose how to handle)
        return $value;
    }

    /**
     * Normalize arrays recursively (both list and associative).
     *
     * @param array<string|int, mixed> $arr
     * @return array<string|int, mixed>
     */
    protected function normalizeArray(array $arr): array
    {

        $out = array_map(function ($v) {
            return $this->normalizeValue($v);
        }, $arr);

        // Only remove nulls at the current level; nested calls already handled.
        return $this->withoutNulls($out);
    }
}