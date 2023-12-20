<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Types;

enum SubscriptionType: string
{
    case Webhook = 'WEBHOOK';

    case GCPPubSub = 'GCP_PUBSUB';
}
