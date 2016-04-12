<?php

namespace Asarturas\Neo4jMagento\Node;

use Asarturas\Neo4j\Cypher\Node;

class Product extends Node
{
    const NODE = 'PRODUCT';

    public static function withIdAndNameAndPrice($id, $name, $price)
    {
        return new Product(
            [
                'id' => $id,
                'name' => $name,
                'price' => $price,
            ]
        );
    }

    public function name()
    {
        return $this->parameters['name'];
    }

    public function price()
    {
        return $this->parameters['price'];
    }
}
