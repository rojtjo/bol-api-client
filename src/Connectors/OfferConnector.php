<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Connectors;

use Rojtjo\Bol\Api;
use Rojtjo\Bol\Common\ConnectorAbstract;
use Rojtjo\Bol\Types\CreateOfferRequest;
use Rojtjo\Bol\Types\ExportOfferCollection;
use Rojtjo\Bol\Types\Offer;
use Rojtjo\Bol\Types\ProcessStatus;
use Rojtjo\Bol\Types\UpdateOfferPriceRequest;
use Rojtjo\Bol\Types\UpdateOfferRequest;
use Rojtjo\Bol\Types\UpdateOfferStockRequest;

final class OfferConnector extends ConnectorAbstract
{
    protected function api(): Api
    {
        return Api::Retailer;
    }

    public function offer(string $offerId): Offer
    {
        $data = $this->send('GET', "offers/$offerId");

        return Offer::fromPayload($data);
    }

    public function createOffer(CreateOfferRequest $request): ProcessStatus
    {
        $data = $this->send('POST', 'offers', body: $request);

        return ProcessStatus::fromPayload($data);
    }

    public function updateOffer(string $offerId, UpdateOfferRequest $request): ProcessStatus
    {
        $data = $this->send('PUT', "offers/$offerId", body: $request);

        return ProcessStatus::fromPayload($data);
    }

    public function updateOfferPrice(string $offerId, UpdateOfferPriceRequest $request): ProcessStatus
    {
        $data = $this->send('PUT', "offers/$offerId/price", body: $request);

        return ProcessStatus::fromPayload($data);
    }

    public function updateOfferStock(string $offerId, UpdateOfferStockRequest $request): ProcessStatus
    {
        $data = $this->send('PUT', "offers/$offerId/stock", body: $request);

        return ProcessStatus::fromPayload($data);
    }

    public function deleteOffer(string $offerId): ProcessStatus
    {
        $data = $this->send('DELETE', "offers/$offerId");

        return ProcessStatus::fromPayload($data);
    }

    public function requestOfferExportFile(): ProcessStatus
    {
        $data = $this->send('POST', 'offers/export', body: [
            'format' => 'CSV',
        ]);

        return ProcessStatus::fromPayload($data);
    }

    public function retrieveOfferExportFile(string $exportId): ExportOfferCollection
    {
        $data = $this->send('GET', "offers/export/$exportId", headers: [
            'Accept' => 'application/vnd.retailer.v10+csv',
        ]);

        return ExportOfferCollection::fromPayload($data);
    }
}
