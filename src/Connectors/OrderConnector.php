<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Connectors;

use Rojtjo\Bol\Api;
use Rojtjo\Bol\Common\ConnectorAbstract;
use Rojtjo\Bol\Types\FulfilmentMethod;
use Rojtjo\Bol\Types\Order;
use Rojtjo\Bol\Types\OrderStatus;
use Rojtjo\Bol\Types\ReducedOrderCollection;

final class OrderConnector extends ConnectorAbstract
{
    protected function api(): Api
    {
        return Api::Retailer;
    }

    public function orders(FulfilmentMethod $fulfilment = FulfilmentMethod::ByRetailer, OrderStatus $status = OrderStatus::Open): ReducedOrderCollection
    {
        $data = $this->send('GET', 'orders', query: [
            'fulfilment-method' => $fulfilment,
            'status'            => $status,
        ]);

        return ReducedOrderCollection::fromPayload($data);
    }

    public function order(string $orderId): Order
    {
        $data = $this->send('GET', "orders/$orderId");

        return Order::fromPayload($data);
    }
}
