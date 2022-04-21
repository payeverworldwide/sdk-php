Feature: List Channel Sets
  In order to use appropriate channel set according to application

  Background:
    Given Payments API is available
    And Payments Configuration is loaded

  Scenario: List Channel Sets (successful)
    When I create valid list channel sets request
    Then The response should be successful