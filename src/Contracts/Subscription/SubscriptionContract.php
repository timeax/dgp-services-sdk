<?php
declare(strict_types=1);

namespace Dgp\Sdk\Contracts\Subscription;

use Dgp\Sdk\Support\Result;
use Dgp\Sdk\Payloads\Requests\Subscription\CreateSubscriptionRequest;
use Dgp\Sdk\Payloads\Requests\Subscription\GetSubscriptionStatusRequest;
use Dgp\Sdk\Payloads\Requests\Subscription\CancelSubscriptionRequest;
use Dgp\Sdk\Payloads\Responses\Subscription\CreateSubscriptionResponse;
use Dgp\Sdk\Payloads\Responses\Subscription\GetSubscriptionStatusResponse;
use Dgp\Sdk\Payloads\Responses\Subscription\CancelSubscriptionResponse;

interface SubscriptionContract
{
    /** @return Result<CreateSubscriptionResponse> */
    public function createSubscription(CreateSubscriptionRequest $request): Result;

    /** @return Result<GetSubscriptionStatusResponse> */
    public function getSubscriptionStatus(GetSubscriptionStatusRequest $request): Result;

    /** @return Result<CancelSubscriptionResponse> */
    public function cancelSubscription(CancelSubscriptionRequest $request): Result;
}