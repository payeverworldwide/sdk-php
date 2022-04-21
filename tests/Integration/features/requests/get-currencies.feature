Feature: Get Currencies
  In order to manage currencies

  Background:
    Given Payments API is available

  Scenario Outline: Get Currencies
    When I create valid get currencies token request for "<country>" country
    Then The response should be successful

    Examples:
    | country |
    | en      |
    | de      |
    | dk      |
    | se      |
