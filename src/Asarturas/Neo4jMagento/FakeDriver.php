<?php

namespace Asarturas\Neo4jMagento;

use Asarturas\Neo4jMagento\Node\Order;

class FakeDriver implements DriverInterface
{
    private $orders = [];

    public function importOrder(Order $order)
    {
        $this->orders = [$order];
    }

    public function getAllOrders()
    {
        return $this->orders;
    }
}
