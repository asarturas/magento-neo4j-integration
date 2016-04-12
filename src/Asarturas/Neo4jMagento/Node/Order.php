<?php

namespace Asarturas\Neo4jMagento\Node;

use Asarturas\Neo4j\Cypher\Node;

class Order extends Node
{
    const NODE = 'ORDER';

    /**
     * @param Product[] $products
     * @return Order
     */
    public static function withIdAndProducts($id, array $products)
    {
        return new Order(['id' => $id], ['contains' => $products]);
    }

    public function products()
    {
        return $this->relations['contains'];
    }
}
