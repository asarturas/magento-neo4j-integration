<?php

namespace Asarturas\Pages\Page;

use Behat\Mink\Element\NodeElement;
use SensioLabs\Behat\PageObjectExtension\PageObject\Page;

class Admin extends Page
{
    protected $path = '/admin';

    public function login()
    {
        $this->fillField('login[username]', 'admin');
        $this->fillField('login[password]', 'admin123123');
        $this->find('css', '.form-button')->press();
    }

    public function gotoConfig()
    {
        /** @var NodeElement $topMenu */
        foreach ($this->findAll('css', 'li.level0 > a > span') as $topMenu) {
            if ($topMenu->getHtml() == 'System') {
                $topMenu->getParent()->click();
                /** @var NodeElement $menuLink */
                foreach ($this->findAll('css', 'li.last a span') as $menuLink) {
                    if ($menuLink->getHtml() == 'Configuration') {
                        $menuLink->getParent()->click();
                        return;
                    }
                }
            }
        }

        throw new \Exception("Was not able to go to system configuration. \n\n" . $this->getHtml());
    }

    public function openNeo4jIntegrationSettings()
    {
        /** @var NodeElement $item */
        foreach ($this->findAll('css', 'dd a span') as $item) {
            if ($item->getHtml() == "Neo4j Integration") {
                $item->getParent()->click();
                return;
            }
        }
        throw new \Exception("'Neo4j Integration' configuration space was not found.\n\n" . $this->getHtml());
    }
}
