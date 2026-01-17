<?php
declare(strict_types=1);

namespace Dgp\Sdk\Payloads\Responses\Ops;

use JsonSerializable;
use Dgp\Sdk\Types\Ops\WebhookEvent;

final class ParseWebhookResponse implements JsonSerializable
{
    public function __construct(
        public readonly WebhookEvent $event,
        public readonly bool $verified = false,
    ) {}

    public function jsonSerialize(): array
    {
        return [
            'event' => $this->event,
            'verified' => $this->verified,
        ];
    }
}