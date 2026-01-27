<?php declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Common;

use JsonSerializable;
use Timeax\ConfigSchema\Support\ConfigBag;

/**
 * Runtime config for a DGP provider driver.
 *
 * - options: non-sensitive config (base URL, timeouts, mode flags, etc.)
 * - secrets: sensitive keys (api_key, token, secret, etc.)
 *
 * NOTE: secrets are intentionally excluded from jsonSerialize() by default.
 */
final readonly class ProviderConfig extends ConfigBag
{
}