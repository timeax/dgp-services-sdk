<?php
declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Responses\Catalog;

use Dgp\Sdk\Types\Schema\ServiceProps;

final readonly class GetServiceSchemaCatalogResponse
{
    /**
     * @param list<ServiceProps> $schemas
     */
    public function __construct(
        public array $schemas,
    )
    {
    }
}