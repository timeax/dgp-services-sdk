<?php
declare(strict_types=1);

namespace Dgp\Sdk\Types\Ops;

final class WebhookEventType
{
    public const ORDER_STATUS = 'order.status';
    public const REFILL_STATUS = 'refill.status';
    public const BALANCE = 'balance';

    private function __construct() {}
}