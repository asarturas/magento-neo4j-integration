<?php

namespace Asarturas\Pages\Page;

use Behat\Mink\Element\NodeElement;
use Exception;
use SensioLabs\Behat\PageObjectExtension\PageObject\Page;

class Admin extends Page
{
    protected $path = '/admin';

    public function login()
    {
        $this->fillField('login[username]', 'admin');
        $this->fillField('login[password]', 'admin123');
        $this->find('css', '.form-button')->press();
    }

    public function gotoConfig()
    {
        $this->expandSystemSubmenu();
        /** @var NodeElement $menuLink */
        foreach ($this->findAll('css', 'li.last a span') as $menuLink) {
            if ($menuLink->getHtml() == 'Configuration') {
                $menuLink->getParent()->click();
                return;
            }
        }
        throw new \Exception("Was not able to go to system configuration. \n\n" . $this->getHtml());
    }

    private function expandSystemSubmenu()
    {
        /** @var NodeElement $topMenu */
        foreach ($this->findAll('css', 'li.level0 > a > span') as $topMenu) {
            if (trim($topMenu->getHtml()) == 'System') {
                $topMenu->getParent()->click();
                return;
            }
        }
        throw new \Exception("System submenu was not found. \n\n" . $this->getHtml());
    }

    public function openNeo4jIntegrationSettings()
    {
        /** @var NodeElement $item */
        foreach ($this->findAll('css', 'dd a span') as $item) {
            if (trim($item->getHtml()) == "Neo4j Integration") {
                $item->getParent()->click();
                return;
            }
        }
        throw new \Exception("'Neo4j Integration' configuration space was not found.\n\n");
    }

    public function fillInNeo4jServerDetails($host, $port, $username, $password)
    {
        if (!$this->find('css', '#asarturas_neo4j_config-head')) {
            throw new Exception("Neo4j Config header was not found.\n\n" . $this->getHtml());
        }
        if (!$this->findField('asarturas_neo4j_config_host')->isVisible()) {
            $this->find('css', '#asarturas_neo4j_config-head')->click();
        }
        $this->fillField('asarturas_neo4j_config_host', $host);
        $this->fillField('asarturas_neo4j_config_port', $port);
        $this->fillField('asarturas_neo4j_config_username', $username);
        $this->fillField('asarturas_neo4j_config_password', $password);
    }

    public function saveSystemConfig()
    {
        /** @var NodeElement $buttonLabel */
        foreach ($this->findAll('css', 'button.save > span > span > span') as $buttonLabel) {
            if (trim($buttonLabel->getHtml()) == 'Save Config') {
                $buttonLabel->getParent()->getParent()->getParent()->click();
                return;
            }
        }
        throw new Exception("Config submit button not found.\n\n" . $this->getHtml());
    }

    public function exportOrdersManually()
    {
        $this->pressButton('export_all_orders_button');
    }
}
