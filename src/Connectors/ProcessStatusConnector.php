<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Connectors;

use Rojtjo\Bol\Api;
use Rojtjo\Bol\Common\ConnectorAbstract;
use Rojtjo\Bol\Types\ProcessStatus;

final class ProcessStatusConnector extends ConnectorAbstract
{
    protected function api(): Api
    {
        return Api::Shared;
    }

    public function processStatus(string $processStatusId): ProcessStatus
    {
        $data = $this->send('GET', "process-status/$processStatusId");

        return ProcessStatus::fromPayload($data);
    }
}
