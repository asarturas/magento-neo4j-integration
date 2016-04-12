<?php

namespace spec\Asarturas\Neo4j\Cypher;

use Asarturas\Neo4j\Cypher\Product;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class StatementSpec extends ObjectBehavior
{
    function it_returns_string_and_parameters()
    {;
        $this->beConstructedWith("MERGE (n:PRODUCT { id: {someid} });", ['someid' => 'some-id']);
        $this->query()->shouldReturn("MERGE (n:PRODUCT { id: {someid} });");
        $this->parameters()->shouldReturn(['someid' => 'some-id']);
    }
}
