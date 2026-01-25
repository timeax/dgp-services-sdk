<?php
declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Requests\Catalog;

final readonly class GetServiceSchemaCatalogRequest
{
    public function __construct(
        /**
         * Optional: if host wants to limit the amount returned.
         * Leave null to return all.
         * @var list<string>|null
         */
        public ?array $serviceIds = null,
    ) {}
}