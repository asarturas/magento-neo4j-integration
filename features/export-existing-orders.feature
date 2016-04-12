Feature: export existing orders
  In order to infer hidden dependencies between placed orders
  As a data analyst, who is fluent with neo4j
  I want to export placed orders information to the neo4j instance of my choice

  @end2end
  Scenario: configure target neo4j database
    Given I am logged in administrator
    When I go to neo4j integration configuration panel
    And submit my neo4j server details
    Then my neo4j server details should be stored in database

  @end2end @wip
  Scenario: manually export existing orders
    Given I am logged in administrator
    When I go to neo4j integration configuration panel
    And I choose to manually export all the existing orders
    Then my existing orders should be exported to neo4j

  @domain @integration @wip
  Scenario: export one order to neo4j
    Given there is one order with one product for 199 pounds
    And the neo4j database is empty
    When I import this order to neo4j
    Then this order should be available in neo4j database
