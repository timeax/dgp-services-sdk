<?php
declare(strict_types=1);

namespace Dgp\Sdk\Contracts\Discovery;

use Dgp\Sdk\Payloads\Responses\Discovery\ResolveProviderServiceResponse;
use Dgp\Sdk\Support\Result;
use Dgp\Sdk\Payloads\Requests\Discovery\ResolveProviderServiceRequest;

interface ServiceMapperContract
{
    /**
     * Resolve a host/internal service reference into the provider's service id/key (and optional variant metadata).
     *
     * This is useful when:
     * - provider catalogs are unstable
     * - provider uses composite ids/variants
     * - host wants driver-owned mapping rules
     *
     * @return Result<ResolveProviderServiceResponse>
     */
    public function resolveProviderService(ResolveProviderServiceRequest $request): Result;
}