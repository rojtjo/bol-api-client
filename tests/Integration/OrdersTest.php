<?php

declare(strict_types=1);

namespace Tests\Integration;

use Rojtjo\Bol\Types\FulfilmentMethod;
use Rojtjo\Bol\Types\OrderStatus;

final class OrdersTest extends IntegrationTestCase
{
    /**
     * @test
     * @see https://api.bol.com/retailer/public/Retailer-API/demo/v10-ORDERS.html#_get_single_fbb_order_with_order_id_1042823870
     */
    public function get_single_fbb_order_with_order_id_1042823870(): void
    {
        $order = $this->bol
            ->orders()
            ->order('1042823870');

        $this->assertMatchesObjectSnapshot($order);
    }

    /**
     * @test
     * @see https://api.bol.com/retailer/public/Retailer-API/demo/v10-ORDERS.html#_get_single_fbr_order_with_order_id_1042831430
     */
    public function get_single_fbr_order_with_order_id_1042831430(): void
    {
        $order = $this->bol
            ->orders()
            ->order('1042831430');

        $this->assertMatchesObjectSnapshot($order);
    }

    /**
     * @test
     * @see https://api.bol.com/retailer/public/Retailer-API/demo/v10-ORDERS.html#_get_single_fbr_order_with_order_id_1042831430
     */
    public function get_single_fbb_order_with_order_id_1043965710(): void
    {
        $order = $this->bol
            ->orders()
            ->order('1043965710');

        $this->assertMatchesObjectSnapshot($order);
    }

    /**
     * @test
     * @see https://api.bol.com/retailer/public/Retailer-API/demo/v10-ORDERS.html#_get_single_fbr_order_with_order_id_a4k8290lp0
     */
    public function get_single_fbr_order_with_order_id_a4k8290lp0(): void
    {
        $order = $this->bol
            ->orders()
            ->order('A4K8290LP0');

        $this->assertMatchesObjectSnapshot($order);
    }

    /**
     * @test
     * @see https://api.bol.com/retailer/public/Retailer-API/demo/v10-ORDERS.html#_get_single_fbr_order_with_order_id_1043946570
     */
    public function get_single_fbr_order_with_order_id_1043946570(): void
    {
        $order = $this->bol
            ->orders()
            ->order('1043946570');

        $this->assertMatchesObjectSnapshot($order);
    }

    /**
     * @test
     * @see https://api.bol.com/retailer/public/Retailer-API/demo/v10-ORDERS.html#_get_single_fbr_order_with_order_id_b3k8290lp0
     */
    public function get_single_fbr_order_with_order_id_b3k8290lp0(): void
    {
        $order = $this->bol
            ->orders()
            ->order('B3K8290LP0');

        $this->assertMatchesObjectSnapshot($order);
    }

    /**
     * @test
     * @see https://api.bol.com/retailer/public/Retailer-API/demo/v10-ORDERS.html#_get_fbb_orders_with_status_all
     */
    public function get_fbb_orders_with_status_all(): void
    {
        $orders = $this->bol
            ->orders()
            ->orders(FulfilmentMethod::ByBol, OrderStatus::All);

        $this->assertMatchesObjectSnapshot($orders);
    }

    /**
     * @test
     * @see https://api.bol.com/retailer/public/Retailer-API/demo/v10-ORDERS.html#_get_fbb_orders_with_status_open
     */
    public function get_fbb_orders_with_status_open(): void
    {
        $orders = $this->bol
            ->orders()
            ->orders(FulfilmentMethod::ByBol, OrderStatus::Open);

        $this->assertMatchesObjectSnapshot($orders);
    }

    /**
     * @test
     * @see https://api.bol.com/retailer/public/Retailer-API/demo/v10-ORDERS.html#_get_fbr_orders_with_status_all
     */
    public function get_fbr_orders_with_status_all(): void
    {
        $orders = $this->bol
            ->orders()
            ->orders(FulfilmentMethod::ByRetailer, OrderStatus::All);

        $this->assertMatchesObjectSnapshot($orders);
    }

    /**
     * @test
     * @see https://api.bol.com/retailer/public/Retailer-API/demo/v10-ORDERS.html#_get_fbr_orders_with_status_open
     */
    public function get_fbr_orders_with_status_open(): void
    {
        $orders = $this->bol
            ->orders()
            ->orders(FulfilmentMethod::ByRetailer, OrderStatus::Open);

        $this->assertMatchesObjectSnapshot($orders);
    }
}
