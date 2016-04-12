<?php

namespace spec\Asarturas\Neo4jMagento;

use Asarturas\Neo4jMagento\Node\Order;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FakeDriverSpec extends ObjectBehavior
{
    function it_is_driver()
    {
        $this->shouldHaveType('Asarturas\Neo4jMagento\DriverInterface');
    }

    function it_stores_and_returns_imported_orders(Order $order)
    {
        $this->importOrder($order);
        $this->getAllOrders()->shouldReturn([$order]);
    }
}
