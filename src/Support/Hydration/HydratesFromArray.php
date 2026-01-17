<?php
declare(strict_types=1);

namespace Dgp\Sdk\Support\Hydration;

/**
 * Trait for DTOs that want a standard ::fromArray(array $data) constructor.
 *
 * This delegates to DtoHydrator which:
 * - matches constructor param names
 * - tolerates snake_case / camelCase keys
 * - hydrates nested DTOs that also support ::fromArray()
 */
trait HydratesFromArray
{
    /**
     * @param array<string,mixed> $data
     */
    public static function fromArray(array $data): static
    {
        /** @var static $dto */
        $dto = DtoHydrator::hydrate(static::class, $data);
        return $dto;
    }
}