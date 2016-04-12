<?php

namespace spec\Asarturas\Neo4j\Cypher;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class NodeSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(
            [
                "identity" => "some-identity",
                "value" => "Some Value",
            ],
            [
                "parent" => new \StdClass(),
                "siblings" => [new \StdClass(), new \StdClass()],
            ]
        );
    }

    function it_returns_cypher_string()
    {
        $this->getCypherString()
            ->shouldReturn("(someidentity:NODE { identity: {someidentityidentity}, value: {someidentityvalue} })");
    }

    function it_returns_cypher_parameters()
    {
        $this->getCypherParameters()
            ->shouldReturn(
                [
                    "someidentityidentity" => "some-identity",
                    "someidentityvalue" => "Some Value"
                ]
            );
    }

    function it_returns_relations()
    {
        $this->getRelations()
            ->shouldBeLike(
                [
                    "parent" => new \StdClass(),
                    "siblings" => [new \StdClass(), new \StdClass()]
                ]
            );
    }
}
