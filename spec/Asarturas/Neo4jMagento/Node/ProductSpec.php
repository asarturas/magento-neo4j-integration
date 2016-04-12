<?php

namespace spec\Asarturas\Neo4jMagento\Node;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ProductSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedThrough("withIdAndNameAndPrice", ["armchair-3", "Black Armchair", 149]);
    }

    function it_is_cypher_node()
    {
        $this->shouldHaveType('Asarturas\Neo4j\Cypher\Node');
    }

    function it_returns_id()
    {
        $this->id()->shouldBe('armchair-3');
    }

    function it_returns_name()
    {
        $this->name()->shouldBe('Black Armchair');
    }

    function it_returns_price()
    {
        $this->price()->shouldBe(149);
    }

    function it_returns_cypher_string()
    {
        $this->getCypherString()
            ->shouldReturn("(armchair3:PRODUCT { id: {armchair3id}, name: {armchair3name}, price: {armchair3price} })");
    }

    function it_returns_cypher_parameters()
    {
        $this->getCypherParameters()
            ->shouldReturn(
                [
                    "armchair3id" => "armchair-3",
                    "armchair3name" => "Black Armchair",
                    "armchair3price" => 149
                ]
            );
    }
}
