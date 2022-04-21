Feature: Token
  In order to use SDK
  As developer
  Token class must provide it's functionality

  Scenario: Check scopes for validness
    Given I check the following scopes:
    | scope               | valid |
    | API_CREATE_PAYMENT  | true  |
    | API_PAYMENT_ACTIONS | true  |
    | API_PAYMENT_INFO    | true  |
    | API_DUMMY_SCOPE     | false |