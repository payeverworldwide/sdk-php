Feature: Cancel Payment
  In order to inform API about cancellation of payment

  Background:
    Given Payments API is available
    And Payments Configuration is loaded

  Scenario Outline: Create Payment (successful)
    Given I expect payment redirect url to be "success_url"
    And I expect payment status to be "STATUS_ACCEPTED"
    When I create valid create payment request with the following:
      | property             | value                                                                            |
      | channel              | <channel>                                                                        |
      | channelSetId         | <channelSetId>                                                                   |
      | paymentMethod        | <paymentMethod>                                                                  |
      | amount               | <amount>                                                                         |
      | fee                  | <fee>                                                                            |
      | orderId              | <orderId>                                                                        |
      | currency             | <currency>                                                                       |
      | cart                 | <cart>                                                                           |
      | salutation           | <salutation>                                                                     |
      | firstName            | <firstName>                                                                      |
      | lastName             | <lastName>                                                                       |
      | street               | <street>                                                                         |
      | zip                  | <zip>                                                                            |
      | city                 | <city>                                                                           |
      | country              | <country>                                                                        |
      | socialSecurityNumber | <socialSecurityNumber>                                                           |
      | birthdate            | <birthdate>                                                                      |
      | phone                | <phone>                                                                          |
      | email                | <email>                                                                          |
      | successUrl           | http://test.sdk.payever.com/response.php?paymentId=PID&type=success              |
      | failureUrl           | http://test.sdk.payever.com/response.php?paymentId=PID&type=error                |
      | cancelUrl            | http://test.sdk.payever.com/response.php?paymentId=PID&type=cancel               |
      | noticeUrl            | http://test.sdk.payever.com/notice.php?paymentId=PID&type=notice                 |
      | pendingUrl           | http://test.sdk.payever.com/response.php?paymentId=PID&type=success&is_pending=1 |
      | xFrameHost           | <xFrameHost>                                                                     |
      | pluginVersion        | <pluginVersion>                                                                  |
    And The response should be successful
    Then I save payment ID
    And I expect payment action "cancel" to be allowed
    And I create valid cancel payment request
    And The response should be successful

    Examples:
      | channel  | channelSetId | paymentMethod        | amount  | fee | orderId | currency | cart               | salutation | firstName | lastName | street            | zip   | city      | country | socialSecurityNumber | birthdate   | phone         | email                          | xFrameHost | pluginVersion         |
      | presta   |              | payex_faktura        | 3754.21 | 0   | 1       | SEK      | [{"name":"dummy"}] | mr         | Stub      | Accepted | Standard 2        | 27343 | Stockholm | SE      |                      | 1990-06-30  | +460102392874 | stubaccepted@sdk.payever.com   |             | prest17payever@v2.0.0 |
      | magento  |              | santander_invoice_de | 140.32  | 0   | 2       | EUR      | [{"name":"dummy"}] | mrs        | Stub      | Pending  | Knauf Strasse 239 | 94821 | Hamburg   | DE      |                      | 1989-03-09  | +44829485729  | stubinprogress@sdk.payever.com |             | m2payever@v2.0.0      |
