Feature: Refresh Token
  In order to continue using SDK
  User authorization via oAuth2 Token is required

  Background:
    Given Payments API is available
    And Payments Configuration is loaded

  Scenario Outline: Refresh using getToken (successful)
    Given I get token with "<scope>" scope
    Then The token must have the following:
      | property      |
      | access_token  |
      | refresh_token |
      | created_at    |
      | updated_at    |
      | scope         |
    And The "scope" property of "token" must be equal to "<scope>"
    When I update token with "<scope>" scope and set "updated_at" property with date "yesterday"
    Then Token with "<scope>" scope should be expired
    But I get token with "<scope>" scope
    Then Token with "<scope>" scope should not be expired
    And The token must have the following:
      | property      |
      | access_token  |
      | refresh_token |
      | created_at    |
      | updated_at    |
      | scope         |
    And The "updated_at" property of "token" must be greater than 0

    Examples:
      | scope               |
      | API_CREATE_PAYMENT  |
      | API_PAYMENT_ACTIONS |
      | API_PAYMENT_INFO    |

  Scenario Outline: Refresh using direct call (successful)
    Given I get token with "<scope>" scope
    Then The token must have the following:
      | property      |
      | access_token  |
      | refresh_token |
      | created_at    |
      | updated_at    |
      | scope         |
    And The "scope" property of "token" must be equal to "<scope>"
    When I create valid refresh token request with "<scope>" scope
    Then The response should be successful
    And Response must contain response entity with the following:
      | property      |
      | access_token  |
      | refresh_token |
      | scope         |
      | expires_in    |

    Examples:
      | scope               |
      | API_CREATE_PAYMENT  |
      | API_PAYMENT_ACTIONS |
      | API_PAYMENT_INFO    |
