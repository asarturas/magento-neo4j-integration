<?php

namespace Asarturas\Neo4jMagento;

use Asarturas\Neo4jMagento\Node\Order;

interface DriverInterface
{

    public function importOrder(Order $order);

    public function getAllOrders();
}
