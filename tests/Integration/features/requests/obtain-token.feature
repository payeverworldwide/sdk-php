Feature: Obtain Token
  In order to use SDK
  User authorization via oAuth2 Token is required

  Background:
    Given Payments API is available
    And Payments Configuration is loaded

  Scenario Outline: Obtain using direct call (successful)
    Given My "<scope>" scope is valid
    When I create valid obtain token request with "<scope>" scope
    Then The response should be successful
    And Response must contain response entity with the following:
      | property      |
      | access_token  |
      | refresh_token |
      | expires_in    |
      | scope         |
      | token_type    |

    Examples:
      | scope               |
      | API_CREATE_PAYMENT  |
      | API_PAYMENT_ACTIONS |
      | API_PAYMENT_INFO    |

  Scenario Outline: Obtain using getToken (successful)
    Given I get token with "<scope>" scope
    Then The token must have the following:
      | property      |
      | access_token  |
      | refresh_token |
      | created_at    |
      | updated_at    |
      | scope         |
    And The "scope" property of "token" must be equal to "<scope>"

    Examples:
      | scope               |
      | API_CREATE_PAYMENT  |
      | API_PAYMENT_ACTIONS |
      | API_PAYMENT_INFO    |

  Scenario: Try to obtain using dummy scope (check failure)
    When I create not valid obtain token request with "API_DUMMY_SCOPE" scope
    Then The response should not be successful
