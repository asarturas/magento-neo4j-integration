<?php

namespace Asarturas\Neo4j\Cypher;

class Node
{
    const NODE = 'NODE';

    protected $id;
    protected $parameters;
    protected $relations;

    public function __construct(array $parameters, array $relations = []) {
        $this->id = reset($parameters);
        foreach ($parameters as $parameter => $value) {
            $this->parameters[$this->prepareParameterName($parameter)] = $value;
        }
        $this->parameters = $parameters;
        $this->relations = $relations;
    }

    private function prepareParameterName($parameterName)
    {
        return preg_replace("/[^a-z0-9]+/i", "", $parameterName);
    }

    public function id()
    {
        return $this->id;
    }

    public function alias()
    {
        return $this->prepareParameterName($this->id);
    }

    public function getCypherString()
    {
        $node = $this->prepareParameterName($this->id) . ":" . $this::NODE;
        return "({$node} {$this->getCypherParameterString()})";
    }

    private function getCypherParameterString()
    {
        $parameters = [];
        foreach ($this->parameters as $parameter => $value) {
            $placeholder = $this->prepareParameterName($this->id) . $parameter;
            $parameters[] = "{$parameter}: {{$placeholder}}";
        }
        return "{ " . implode(", ", $parameters) . " }";
    }

    public function getCypherParameters()
    {
        $parameters = [];
        foreach ($this->parameters as $parameter => $value) {
            $parameters[$this->prepareParameterName($this->id) . $parameter] = $value;
        }
        return $parameters;
    }

    public function getRelations()
    {
        return $this->relations;
    }
}
