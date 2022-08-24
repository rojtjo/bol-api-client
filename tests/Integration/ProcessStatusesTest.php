<?php

declare(strict_types=1);

namespace Tests\Integration;

final class ProcessStatusesTest extends IntegrationTestCase
{
    /**
     * @test
     * @see https://api.bol.com/retailer/public/Retailer-API/demo/v7-PROCESS_STATUS.html#_generate_a_process_status_pending_using_entity_id_and_event_type
     */
    public function generate_a_process_status_pending_using_entity_id_and_event_type(): void
    {
        $processStatus = $this->bol
            ->processStatuses()
            ->processStatus('1');

        $this->assertMatchesObjectSnapshot($processStatus->withFixedTimestamp());
    }

    /**
     * @test
     * @see https://api.bol.com/retailer/public/Retailer-API/demo/v7-PROCESS_STATUS.html#_generate_a_process_status_failure_using_entity_id_and_event_type
     */
    public function generate_a_process_status_failure_using_entity_id_and_event_type(): void
    {
        $processStatus = $this->bol
            ->processStatuses()
            ->processStatus('4');

        $this->assertMatchesObjectSnapshot($processStatus->withFixedTimestamp());
    }

    /**
     * @test
     * @see https://api.bol.com/retailer/public/Retailer-API/demo/v7-PROCESS_STATUS.html#_generate_a_process_status_timeout_using_entity_id_and_event_type
     */
    public function generate_a_process_status_timeout_using_entity_id_and_event_type(): void
    {
        $processStatus = $this->bol
            ->processStatuses()
            ->processStatus('3');

        $this->assertMatchesObjectSnapshot($processStatus->withFixedTimestamp());
    }

    /**
     * @test
     * @see https://api.bol.com/retailer/public/Retailer-API/demo/v7-PROCESS_STATUS.html#_generate_a_process_status_success_using_entity_id_and_event_type
     */
    public function generate_a_process_status_success_using_entity_id_and_event_type(): void
    {
        $processStatus = $this->bol
            ->processStatuses()
            ->processStatus('2');

        $this->assertMatchesObjectSnapshot($processStatus->withFixedTimestamp());
    }
}
