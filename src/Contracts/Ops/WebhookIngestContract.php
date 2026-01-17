<?php
declare(strict_types=1);

namespace Dgp\Sdk\Contracts\Ops;

use Dgp\Sdk\Support\Result;
use Dgp\Sdk\Payloads\Requests\Ops\ParseWebhookRequest;

interface WebhookIngestContract
{
    /**
     * Parse + verify a provider webhook request into a canonical WebhookEvent.
     *
     * @return Result<\Dgp\Sdk\Payloads\Responses\Ops\ParseWebhookResponse>
     */
    public function parseWebhook(ParseWebhookRequest $request): Result;
}