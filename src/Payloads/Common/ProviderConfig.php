<?php declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Common;

use JsonSerializable;

/**
 * Runtime config for a DGP provider driver.
 *
 * - options: non-sensitive config (base URL, timeouts, mode flags, etc.)
 * - secrets: sensitive keys (api_key, token, secret, etc.)
 *
 * NOTE: secrets are intentionally excluded from jsonSerialize() by default.
 */
final readonly class ProviderConfig implements JsonSerializable
{
    /**
     * @param array<string,mixed> $options
     * @param array<string,mixed> $secrets
     */
    public function __construct(
        public bool  $sandbox = false,
        public array $options = [],
        public array $secrets = [],
    )
    {
    }

    public function isSandbox(): bool
    {
        return $this->sandbox;
    }

    public function option(string $key, mixed $default = null): mixed
    {
        return $this->options[$key] ?? $default;
    }

    public function secret(string $key, mixed $default = null): mixed
    {
        return $this->secrets[$key] ?? $default;
    }

    /**
     * Public serialization (safe by default).
     */
    public function jsonSerialize(): array
    {
        return [
            'sandbox' => $this->sandbox,
            'options' => $this->options,
            // secrets intentionally excluded
        ];
    }

    /** @return array{sandbox:bool,options:array<string,mixed>} */
    public function toPublicArray(): array
    {
        /** @var array{sandbox:bool,options:array<string,mixed>} $arr */
        $arr = $this->jsonSerialize();
        return $arr;
    }

    /** @return array{sandbox:bool,options:array<string,mixed>,secrets:array<string,mixed>} */
    public function toPrivateArray(): array
    {
        return [
            'sandbox' => $this->sandbox,
            'options' => $this->options,
            'secrets' => $this->secrets,
        ];
    }
}