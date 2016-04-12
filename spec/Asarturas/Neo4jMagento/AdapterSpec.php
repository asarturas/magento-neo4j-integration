<?php

namespace spec\Asarturas\Neo4jMagento;

use Asarturas\Neo4jMagento\DriverInterface;
use Asarturas\Neo4jMagento\Node\Order;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AdapterSpec extends ObjectBehavior
{
    function let(DriverInterface $driver)
    {
        $this->beConstructedThrough('usingDriver', [$driver]);
    }

    function it_imports_order_via_driver(DriverInterface $driver, Order $order)
    {
        $driver->importOrder($order)->shouldBeCalled();
        $this->importOrder($order);
    }

    function it_returns_all_orders_from_the_driver(DriverInterface $driver, Order $order)
    {
        $driver->getAllOrders()->willReturn([$order]);
        $this->getAllOrders()->shouldReturn([$order]);
    }
}
