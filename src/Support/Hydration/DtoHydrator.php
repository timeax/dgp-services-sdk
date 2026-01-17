<?php
declare(strict_types=1);

namespace Dgp\Sdk\Support\Hydration;

use BackedEnum;
use DateTimeImmutable;
use DateTimeInterface;
use ReflectionClass;
use ReflectionNamedType;
use ReflectionParameter;
use ReflectionType;
use ReflectionUnionType;
use RuntimeException;

final class DtoHydrator
{
    /**
     * Hydrate a DTO by mapping $data keys to the target class constructor parameters.
     *
     * - looks up keys by: exact, snake_case, camelCase
     * - hydrates nested objects if the target type has a static fromArray(array): self
     *
     * @param class-string $class
     * @param array<string,mixed> $data
     */
    public static function hydrate(string $class, array $data): object
    {
        $rc = new ReflectionClass($class);
        $ctor = $rc->getConstructor();

        if (!$ctor) {
            return $rc->newInstance();
        }

        $args = [];
        foreach ($ctor->getParameters() as $p) {
            $args[] = self::resolveParam($p, $data, $class);
        }

        return $rc->newInstanceArgs($args);
    }

    /**
     * @param class-string $class
     * @param array<int, array<string,mixed>> $items
     * @return array<int, object>
     */
    public static function hydrateList(string $class, array $items): array
    {
        $out = [];
        foreach ($items as $row) {
            $out[] = self::hydrate($class, $row);
        }
        return $out;
    }

    /**
     * @param array<string,mixed> $data
     */
    private static function resolveParam(ReflectionParameter $p, array $data, string $class): mixed
    {
        $name = $p->getName();
        $key = self::findKey($data, $name);

        if ($key === null) {
            if ($p->isDefaultValueAvailable()) {
                return $p->getDefaultValue();
            }

            if ($p->allowsNull()) {
                return null;
            }

            throw new RuntimeException("DtoHydrator: missing required key '{$name}' for {$class}.");
        }

        $value = $data[$key];
        return self::castToParamType($p->getType(), $value);
    }

    /**
     * Find the best key in $data matching the param name.
     *
     * @param array<string,mixed> $data
     */
    private static function findKey(array $data, string $paramName): ?string
    {
        $candidates = [
            $paramName,
            self::toSnake($paramName),
            self::toCamel($paramName),
        ];

        foreach ($candidates as $k) {
            if (array_key_exists($k, $data)) {
                return $k;
            }
        }

        return null;
    }

    private static function castToParamType(?ReflectionType $type, mixed $value): mixed
    {
        if ($type === null) {
            return $value;
        }

        // Union type: try each option until one fits/hydrates
        if ($type instanceof ReflectionUnionType) {
            foreach ($type->getTypes() as $t) {
                try {
                    return self::castToParamType($t, $value);
                } catch (\Throwable) {
                    // try next union member
                }
            }

            // If none match, just return raw
            return $value;
        }

        if (!($type instanceof ReflectionNamedType)) {
            return $value;
        }

        if ($value === null) {
            return null;
        }

        $typeName = $type->getName();

        // Built-ins
        if ($type->isBuiltin()) {
            return match ($typeName) {
                'int' => (int)$value,
                'float' => (float)$value,
                'string' => (string)$value,
                'bool' => (bool)$value,
                'array' => (array)$value,
                default => $value,
            };
        }

        // DateTimeInterface
        if (is_a($typeName, DateTimeInterface::class, true)) {
            if ($value instanceof DateTimeInterface) {
                return $value;
            }
            if (is_string($value)) {
                return new DateTimeImmutable($value);
            }
            return $value;
        }

        // Enums
        if (is_a($typeName, BackedEnum::class, true)) {
            if ($value instanceof BackedEnum) {
                return $value;
            }
            /** @var class-string<BackedEnum> $enum */
            $enum = $typeName;
            try {
                return $enum::from($value);
            } catch (\Throwable) {
                return $value;
            }
        }

        // Nested DTO hydration via static fromArray
        if (is_object($value) && is_a($value, $typeName)) {
            return $value;
        }

        if (is_array($value) && method_exists($typeName, 'fromArray')) {
            /** @phpstan-ignore-next-line */
            return $typeName::fromArray($value);
        }

        return $value;
    }

    private static function toSnake(string $v): string
    {
        $v = preg_replace('/(?<!^)[A-Z]/', '_$0', $v) ?? $v;
        return strtolower($v);
    }

    private static function toCamel(string $v): string
    {
        if (!str_contains($v, '_')) {
            return $v;
        }
        $v = str_replace('_', ' ', $v);
        $v = ucwords($v);
        $v = str_replace(' ', '', $v);
        return lcfirst($v);
    }
}