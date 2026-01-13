<?php
declare(strict_types=1);

namespace Dgp\Sdk\Driver;

final readonly class DriverResolver
{
    public function __construct(
        private DriverRegistry $registry,
    ) {}

    public function resolve(string $key, DriverContext $context): object
    {
        $factory = $this->registry->factory($key);

        return $factory($context);
    }
}