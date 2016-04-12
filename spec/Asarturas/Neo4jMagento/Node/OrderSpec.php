<?php

namespace spec\Asarturas\Neo4jMagento\Node;

use Asarturas\Neo4jMagento\Node\Product;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class OrderSpec extends ObjectBehavior
{
    function let(Product $product)
    {
        $this->beConstructedThrough('withIdAndProducts', ["o1", [$product]]);
    }

    function it_is_node()
    {
        $this->shouldHaveType('Asarturas\Neo4j\Cypher\Node');
    }

    function it_returns_id()
    {
        $this->id()->shouldBe("o1");
    }

    function it_returns_products(Product $product)
    {
        $this->products()->shouldReturn([$product]);
    }

    function it_returns_cypher_string()
    {
        $this->getCypherString()
            ->shouldReturn("(o1:ORDER { id: {o1id} })");
    }

    function it_returns_cypher_parameters()
    {
        $this->getCypherParameters()
            ->shouldReturn(
                [
                    "o1id" => "o1",
                ]
            );
    }
}
