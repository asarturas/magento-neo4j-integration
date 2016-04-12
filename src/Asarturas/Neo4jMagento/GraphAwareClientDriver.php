<?php

namespace Asarturas\Neo4jMagento;

use Asarturas\Neo4j\Cypher\Statement;
use Asarturas\Neo4jMagento\Node\Order;
use GraphAware\Neo4j\Client\Client;

class GraphAwareClientDriver implements DriverInterface
{
    /** @var Client */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function importOrder(Order $order)
    {
        $statements = [];
        foreach ($order->products() as $product) {
            $statements[] = new Statement("MERGE {$product->getCypherString()};", $product->getCypherParameters());
        }
        $statements[] = new Statement("MERGE {$order->getCypherString()};", $order->getCypherParameters());
        foreach ($order->products() as $product) {
            $statements[] = new Statement(
                "MATCH {$order->getCypherString()}, {$product->getCypherString()} MERGE ({$order->alias()}) -[:CONTAINS]-> ({$product->alias()});",
                $order->getCypherParameters() + $product->getCypherParameters()
            );
        }

        $transaction = $this->client->transaction();
        foreach ($statements as $statement) {
            $transaction->push($statement->query(), $statement->parameters());
        }
        $transaction->commit();
    }

    public function getAllOrders()
    {
        // TODO: Implement getAllOrders() method.
    }
}
