<?php
declare(strict_types=1);

namespace Dgp\Sdk\Driver;

use Dgp\Sdk\Contracts\Infra\TransportContract;
use Dgp\Sdk\Payloads\Common\ProviderConfig;

final readonly class DriverContext
{
    public function __construct(
        public ProviderConfig    $config,
        public TransportContract $transport,
    )
    {
    }

    public function isSandbox(): bool
    {
        return $this->config->isSandbox();
    }

    public function option(string $key, mixed $default = null): mixed
    {
        return $this->config->option($key, $default);
    }

    public function secret(string $key, mixed $default = null): mixed
    {
        return $this->config->secret($key, $default);
    }
}