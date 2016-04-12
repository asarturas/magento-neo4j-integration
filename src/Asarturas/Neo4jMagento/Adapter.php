<?php

namespace Asarturas\Neo4jMagento;

use Asarturas\Neo4jMagento\Node\Order;

class Adapter
{
    private $driver;

    private function __construct(DriverInterface $driver)
    {
        $this->driver = $driver;
    }

    public static function usingDriver(DriverInterface $driver)
    {
        return new Adapter($driver);
    }

    public function importOrder(Order $order)
    {
        $this->driver->importOrder($order);
    }

    public function getAllOrders()
    {
        return $this->driver->getAllOrders();
    }
}
