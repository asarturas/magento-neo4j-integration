<?php

use Asarturas\Neo4jMagento\Adapter;
use Asarturas\Neo4jMagento\Node\Order;
use Asarturas\Neo4jMagento\Node\Product;
use Asarturas\Neo4jMagento\GraphAwareClientDriver;
use Asarturas\Pages\Page\Admin;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use GraphAware\Neo4j\Client\ClientBuilder;

/**
 * Defines application features from the specific context.
 */
class IntegrationContext implements Context, SnippetAcceptingContext
{
    /** @var Asarturas\Neo4j\Adapter */
    private $database;
    /** @var Asarturas\Neo4j\Order */
    private $order;

    public function __construct($host, $port, $username, $password)
    {
        $client = ClientBuilder::create()
            ->addConnection('default', "http://{$username}:{$password}@{$host}:{$port}")
            ->build();
        $this->database = Adapter::usingDriver(
            new GraphAwareClientDriver($client)
        );
    }

    /**
     * @Given there is one order with one product for :total pounds
     */
    public function thereIsOneOrderWithOneProductForPounds($total)
    {
        $product = Product::withIdAndNameAndPrice("oak-199", "Oak Chair", 199);
        $this->order = Order::withIdAndProducts("o1", [$product]);
    }

    /**
     * @Given the neo4j database is empty
     */
    public function thereIsTheNeojDatabaseIsEmpty()
    {
    }

    /**
     * @When I import this order to neo4j
     */
    public function iImportThisOrderToNeoj()
    {
        $this->database->importOrder($this->order);
    }

    /**
     * @Then this order should be available in neo4j database
     */
    public function thisOrderShouldBeAvailableInNeojDatabase()
    {
        $orders = $this->database->getAllOrders();
        if (count($orders) != 1) {
            throw new Exception(
                sprintf("Expected to have 1 order in database, but got %s instead.", count($orders))
            );
        }
        expect($orders[0])->toBe($this->order);
    }
}
