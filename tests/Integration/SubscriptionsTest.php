<?php

declare(strict_types=1);

namespace Tests\Integration;

final class SubscriptionsTest extends IntegrationTestCase
{
    /**
     * @test
     * @see https://api.bol.com/retailer/public/api/demo/v8-SUBSCRIPTIONS.html#_retrieve_push_notification_subscription_list
     */
    public function retrieve_push_notification_subscription_list(): void
    {
        $subscriptions = $this->bol
            ->subscriptions()
            ->allSubscriptions();

        $this->assertMatchesObjectSnapshot($subscriptions);
    }

    /**
     * @test
     * @see https://api.bol.com/retailer/public/api/demo/v8-SUBSCRIPTIONS.html#_trigger_sending_of_a_test_push_notification_for_subscription
     */
    public function trigger_sending_of_a_test_push_notification_for_subscription(): void
    {
        $processStatus = $this->bol
            ->subscriptions()
            ->sendTestNotification('54321');

        $this->assertMatchesObjectSnapshot($processStatus->withFixedTimestamp());
    }

    /**
     * @test
     * @see https://api.bol.com/retailer/public/api/demo/v8-SUBSCRIPTIONS.html#_create_push_notification_subscription
     */
    public function create_push_notification_subscription(): void
    {
        $processStatus = $this->bol
            ->subscriptions()
            ->createSubscription(['PROCESS_STATUS'], 'https://www.example.com/push');

        $this->assertMatchesObjectSnapshot($processStatus->withFixedTimestamp());
    }

    /**
     * @test
     * @see https://api.bol.com/retailer/public/api/demo/v8-SUBSCRIPTIONS.html#_delete_existing_push_notification_subscription
     */
    public function delete_existing_push_notification_subscription(): void
    {
        $processStatus = $this->bol
            ->subscriptions()
            ->deleteSubscription('1234');

        $this->assertMatchesObjectSnapshot($processStatus->withFixedTimestamp());
    }

    /**
     * @test
     * @see https://api.bol.com/retailer/public/api/demo/v8-SUBSCRIPTIONS.html#_retrieve_push_notification_subscription
     */
    public function retrieve_push_notification_subscription(): void
    {
        $subscription = $this->bol
            ->subscriptions()
            ->findSubscription('1234');

        $this->assertMatchesObjectSnapshot($subscription);
    }

    /**
     * @test
     * @see https://api.bol.com/retailer/public/api/demo/v8-SUBSCRIPTIONS.html#_update_existing_push_notification_subscription
     */
    public function update_existing_push_notification_subscription(): void
    {
        $processStatus = $this->bol
            ->subscriptions()
            ->updateSubscription('1234', ['PROCESS_STATUS'], 'https://www.example.com/push');

        $this->assertMatchesObjectSnapshot($processStatus->withFixedTimestamp());
    }
}
