<?php /** @noinspection SpellCheckingInspection */
declare(strict_types=1);

namespace Dgp\Sdk\Types\Service;

use InvalidArgumentException;
use JsonSerializable;
use Dgp\Sdk\Support\Serialization\Arrayable;

final readonly class ServiceFlagset implements Arrayable, JsonSerializable
{
    /** @var array<string,ServiceFlag> */
    public array $flags;

    /**
     * @param array<string,ServiceFlag> $flags Map: flagId => ServiceFlag
     */
    public function __construct(array $flags = [])
    {
        $normalized = [];

        foreach ($flags as $flag) {
            if (!$flag instanceof ServiceFlag) {
                throw new InvalidArgumentException('ServiceFlagset expects values of type ServiceFlag.');
            }

            // canonicalize key from the flag id (prevents mismatched keys)
            $normalized[$flag->id] = $flag;
        }

        $this->flags = $normalized;
    }

    public static function defaults(bool $enabledDefault = false): self
    {
        return new self([
            new ServiceFlag(
                id: 'refill',
                enabled: $enabledDefault,
                description: 'Service supports refill after completion (if provider allows).',
            ),
            new ServiceFlag(
                id: 'cancel',
                enabled: $enabledDefault,
                description: 'Service supports cancellation (if provider allows).',
            ),
            new ServiceFlag(
                id: 'dripfeed',
                enabled: $enabledDefault,
                description: 'Service supports drip-feed delivery (if provider allows).',
            ),
            new ServiceFlag(
                id: 'contract',
                enabled: false,
                description: 'Service is a contract-type service (handled via contract flow/contract rules).',
            ),
        ]);
    }

    public function get(string $id): ?ServiceFlag
    {
        return $this->flags[$id] ?? null;
    }

    public function enabled(string $id, bool $default = false): bool
    {
        return $this->flags[$id]->enabled ?? $default;
    }

    public function with(ServiceFlag $flag): self
    {
        $next = $this->flags;
        $next[$flag->id] = $flag;
        return new self($next);
    }

    /** @return array<string,array<string,mixed>> */
    public function toArray(): array
    {
        return array_map(static function ($flag) {
            return $flag->toArray();
        }, $this->flags);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}