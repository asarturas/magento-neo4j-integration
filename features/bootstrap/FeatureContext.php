<?php

use Asarturas\Pages\Page\Admin;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{
    private $admin;

    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }

    /**
     * @Given I am logged in administrator
     */
    public function iAmLoggedInAdministrator()
    {
        $this->admin->open();
        $this->admin->login();
    }

    /**
     * @When I go to neo4j integration configuration panel
     */
    public function iGoToNeo4jIntegrationConfigurationPanel()
    {
        $this->admin->gotoConfig();
        $this->admin->openNeo4jIntegrationSettings();
    }

    /**
     * @When submit my neo4j server details
     */
    public function submitMyNeojServerDetails()
    {
        throw new PendingException();
    }

    /**
     * @Then my neo4j server details are stored in database
     */
    public function myNeojServerDetailsAreStoredInDatabase()
    {
        throw new PendingException();
    }
}
