Feature: export existing orders
  In order to infer hidden dependencies between placed orders
  As a data analyst, who is fluent with neo4j
  I want to export placed orders information to the neo4j instance of my choice

  Scenario: configure target neo4j database
    Given I am logged in administrator
    When I go to neo4j integration configuration panel
    And submit my neo4j server details
    Then my neo4j server details should be stored in database
