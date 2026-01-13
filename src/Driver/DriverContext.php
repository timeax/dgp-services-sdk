<?php
declare(strict_types=1);

namespace Dgp\Sdk\Driver;

use Psr\Log\LoggerInterface;
use Psr\SimpleCache\CacheInterface;
use Psr\Clock\ClockInterface;
use Dgp\Sdk\Contracts\Infra\TransportContract;

final class DriverContext
{
    /**
     * @param array<string, mixed> $config
     * @param array<string, mixed> $meta
     */
    public function __construct(
        public readonly TransportContract $transport,
        public readonly array $config = [],
        public readonly array $meta = [],
        public readonly mixed $handler = null,              // host passes dgp_handler (any shape)
        public readonly ?LoggerInterface $logger = null,
        public readonly ?CacheInterface $cache = null,
        public readonly ?ClockInterface $clock = null,
    ) {}

    /** @return mixed|null */
    public function get(string $key, mixed $default = null): mixed
    {
        return $this->config[$key] ?? $default;
    }
}