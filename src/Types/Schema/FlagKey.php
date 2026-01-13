<?php
declare(strict_types=1);

namespace Dgp\Sdk\Types\Schema;

enum FlagKey: string
{
    case REFILL = 'refill';
    case CANCEL = 'cancel';
    case DRIPFEED = 'dripfeed';
}