<?php
declare(strict_types=1);

namespace Dgp\Sdk\Types\Service;

final class OperationKey
{
    // Catalog / schema
    public const CATALOG_LIST_SERVICES = 'catalog.services.list';

    // Orders
    public const ORDER_CREATE = 'order.create';
    public const ORDER_STATUS = 'order.status';
    public const ORDER_CANCEL = 'order.cancel';

    // Balance
    public const BALANCE_GET = 'balance.get';

    // Refill
    public const REFILL_CREATE = 'refill.create';
    public const REFILL_STATUS = 'refill.status';

    // Bulk
    public const BULK_ORDER_CREATE = 'bulk.orders.create';
    public const BULK_ORDER_STATUS = 'bulk.orders.status';

    // Subscription
    public const SUBSCRIPTION_CREATE = 'subscription.create';
    public const SUBSCRIPTION_STATUS = 'subscription.status';
    public const SUBSCRIPTION_CANCEL = 'subscription.cancel';

    // DripFeed
    public const DRIPFEED_CREATE = 'dripfeed.create';
    public const DRIPFEED_STATUS = 'dripfeed.status';
    public const DRIPFEED_CANCEL = 'dripfeed.cancel';

    private function __construct()
    {
    }
}