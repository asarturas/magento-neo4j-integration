<?php

use Asarturas\Pages\Page\Admin;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use MageTest\MagentoExtension\Context\MagentoContext;

/**
 * Defines application features from the specific context.
 */
class AdminContext extends MagentoContext implements Context, SnippetAcceptingContext
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
        $this->admin->fillInNeo4jServerDetails('neo4j', '7474', 'neo4j', 'neoneo');
        $this->admin->saveSystemConfig();
    }

    /**
     * @Then my neo4j server details should be stored in database
     */
    public function myNeojServerDetailsAreStoredInDatabase()
    {
        if (!strpos($this->admin->getHtml(), 'The configuration has been saved.')) {
            throw new Exception("Was not actually saved\n\n" .  $this->getHtml());
        }
    }
}
