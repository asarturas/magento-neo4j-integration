<?php

namespace spec\Asarturas\Neo4jMagento;

use Asarturas\Neo4j\Cypher\Node;
use Asarturas\Neo4jMagento\Node\Product;
use Asarturas\Neo4jMagento\Node\Order;
use GraphAware\Neo4j\Client\Client;
use GraphAware\Neo4j\Client\Stack;
use GraphAware\Neo4j\Client\Transaction\Transaction;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GraphAwareClientDriverSpec extends ObjectBehavior
{
    function let(Client $client)
    {
        $this->beConstructedWith($client);
    }

    function it_is_driver()
    {
        $this->shouldHaveType('Asarturas\Neo4jMagento\DriverInterface');
    }

    function it_imports_order_into_neo4j_with_cypher_query_via_graph_aware_client(
        Client $client, Transaction $transaction
    )
    {
        $product = Product::withIdAndNameAndPrice('napkin-set', "Luxurious Napkins (x12)", 2.99);
        $order = Order::withIdAndProducts("o1", [$product]);

        $client->transaction()->willReturn($transaction);
        $transaction->push(
            "MERGE (napkinset:PRODUCT { id: {napkinsetid}, name: {napkinsetname}, price: {napkinsetprice} });",
            [
                'napkinsetid' => 'napkin-set',
                'napkinsetname' => 'Luxurious Napkins (x12)',
                'napkinsetprice' => 2.99,
            ]
        )->shouldBeCalled();
        $transaction->push(
            "MERGE (o1:ORDER { id: {o1id} });",
            ['o1id' => 'o1']
        )->shouldBeCalled();
        $transaction->push(
            "MATCH (o1:ORDER { id: {o1id} }), (napkinset:PRODUCT { id: {napkinsetid}, name: {napkinsetname}, price: {napkinsetprice} }) MERGE (o1) -[:CONTAINS]-> (napkinset);",
            ['o1id' => 'o1', 'napkinsetid' => 'napkin-set', 'napkinsetname' => "Luxurious Napkins (x12)", 'napkinsetprice' => 2.99]
        )->shouldBeCalled();
        $transaction->commit()->shouldBeCalled();
        $this->importOrder($order);
    }
}
