<?php

namespace Asarturas\Neo4j\Cypher;

class Statement
{
    private $query;
    private $parameters;

    public function __construct($query, $parameters = [])
    {
        $this->query = $query;
        $this->parameters = $parameters;
    }

    public function query()
    {
        return $this->query;
    }

    public function parameters()
    {
        return $this->parameters;
    }
}
