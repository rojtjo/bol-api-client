<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Connectors;

use Rojtjo\Bol\Api;
use Rojtjo\Bol\Common\ConnectorAbstract;
use Rojtjo\Bol\Types\ProcessStatus;
use Rojtjo\Bol\Types\SignatureKeyCollection;
use Rojtjo\Bol\Types\Subscription;
use Rojtjo\Bol\Types\SubscriptionCollection;

final class SubscriptionConnector extends ConnectorAbstract
{
    protected function api(): Api
    {
        return Api::Retailer;
    }

    public function signatureKeys(): SignatureKeyCollection
    {
        $data = $this->send('GET', 'subscriptions/signature-keys');

        return SignatureKeyCollection::fromPayload($data);
    }

    public function allSubscriptions(): SubscriptionCollection
    {
        $data = $this->send('GET', 'subscriptions');

        return SubscriptionCollection::fromPayload($data);
    }

    public function findSubscription(string $subscriptionId): Subscription
    {
        $data = $this->send('GET', "subscriptions/$subscriptionId");

        return Subscription::fromPayload($data);
    }

    public function createSubscription(array $resources, string $url): ProcessStatus
    {
        $data = $this->send('POST', 'subscriptions', body: [
            'resources' => $resources,
            'url'       => $url,
        ]);

        return ProcessStatus::fromPayload($data);
    }

    public function updateSubscription(string $subscriptionId, array $resources, string $url): ProcessStatus
    {
        $data = $this->send('PUT', "subscriptions/$subscriptionId", body: [
            'resources' => $resources,
            'url'       => $url,
        ]);

        return ProcessStatus::fromPayload($data);
    }

    public function deleteSubscription(string $subscriptionId): ProcessStatus
    {
        $data = $this->send('DELETE', "subscriptions/$subscriptionId");

        return ProcessStatus::fromPayload($data);
    }

    public function sendTestNotification(string $subscriptionId): ProcessStatus
    {
        $data = $this->send('POST', "subscriptions/test/$subscriptionId");

        return ProcessStatus::fromPayload($data);
    }
}
