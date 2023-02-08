# Changelog

## [4.3.1]
### Changed
- Fixed: deprecated functionality: date_create(): Passing null to parameter #1

## [4.3.0]
### Added
- methods `setOrganizationName()`, `getOrganizationName()`, `setStreetType()`, `getStreetType()`, `setFloor()`, `getFloor()`, `setDoor()`, `getDoor()`, `setBlock()`, `getBlock()` in `Payever\ExternalIntegration\Payments\Http\MessageEntity\PaymentDataEntity`

### Changed
- Argument `$paymentData` can accept `PaymentDataEntity` in `setPaymentData($paymentData)` of `Payever\ExternalIntegration\Payments\Http\RequestEntity\SubmitPaymentRequest` and `Payever\ExternalIntegration\Payments\Http\RequestEntity\CreatePaymentV2Request`

## [4.2.0]
### Added
- methods `setCustomerRedirectUrl()` and `getCustomerRedirectUrl()`
- method `setPluginVersion(string $version)` in `Payever\ExternalIntegration\Payments\Http\RequestEntity\CreatePaymentV2Request`
- method `getPluginVersion()` in `Payever\ExternalIntegration\Payments\Http\RequestEntity\CreatePaymentV2Request`

## [4.1.0]
### Added
- class `Payever\ExternalIntegration\Payments\Http\RequestEntity\CancelItemsPaymentRequest`
- method `cancelItemsPaymentRequest($paymentId, $items, $deliveryFee = null)` in `Payever\ExternalIntegration\Payments\PaymentsApiClient`

## [4.0.0]

### Implemented
- /api/v2/payment endpoint

## [3.4.1]

### Added
- New openbank payment method codes

## [3.4.0]

### Added
- methods `setInvoiceId(string $invoiceId)` and `getInvoiceId()` in `Payever\ExternalIntegration\Payments\Http\RequestEntity\ShippingGoodsPaymentRequest`
- methods `setInvoiceUrl(string $invoiceUrl)` and `getInvoiceUrl()` in `Payever\ExternalIntegration\Payments\Http\RequestEntity\ShippingGoodsPaymentRequest`
- methods `setPoNumber(string $poNumber)` and `getPoNumber()` in `Payever\ExternalIntegration\Payments\Http\RequestEntity\ShippingGoodsPaymentRequest`

## [3.3.0]

### Added
- method `getDeliveryFee()` in `Payever\ExternalIntegration\Payments\Http\RequestEntity\RefundItemsPaymentRequest`
- method `setDeliveryFee(float $deliveryFee)` in `Payever\ExternalIntegration\Payments\Http\RequestEntity\RefundItemsPaymentRequest`

### Changed
- method `refundItemsPaymentRequest($paymentId, $items, $deliveryFee = null)` in `PaymentsApiClient`

## [3.2.1]

### Added
- New openbank payment method codes

## [3.2.0]

### Added
- Compatibility with PHP 8.1

## [3.1.3]

### Added
- method `isPartialActionAllowed($paymentId, $transactionAction, $throwException = true): bool` in `Payever\ExternalIntegration\Payments\Action\ActionDecider`
- method `isPartialCancelAllowed($paymentId, $throwException = true): bool` in `Payever\ExternalIntegration\Payments\Action\ActionDecider`
- method `isPartialRefundAllowed($paymentId, $throwException = true): bool` in `Payever\ExternalIntegration\Payments\Action\ActionDecider`
- method `isPartialShippingAllowed($paymentId, $throwException = true): bool` in `Payever\ExternalIntegration\Payments\Action\ActionDecider`

## [3.0.0]

### Added
- Compatibility with PHP 8

## [2.12.0]

### Added
- Class `Payever\ExternalIntegration\Payments\Enum\Salutation`
- Property `authorizationId` in `Payever\ExternalIntegration\ThirdParty\Http\ResponseEntity\SubscriptionResponseEntity`
- Property `integration` in `Payever\ExternalIntegration\ThirdParty\Http\ResponseEntity\SubscriptionResponseEntity`
- Method `setPaymentDetailsArray` in `Payever\ExternalIntegration\Payments\Http\MessageEntity\RetrievePaymentResultEntity`
### Changed
- Property `externalId` in `Payever\ExternalIntegration\ThirdParty\Http\ResponseEntity\SubscriptionResponseEntity` is marked as deprecated
- Method `exportInventory` in `Payever\ExternalIntegration\Inventory\InventoryApiClient` throws exception
- Method `exportProducts` in `Payever\ExternalIntegration\Products\ProductsApiClient` throws exception
- Minor PHPDoc updates

## [2.11.0]

### Changed

- Url constant - `api/shop/oauth/%s/channel-sets` in `Payever\ExternalIntegration\Core\CommonApiClient::SUB_URL_LIST_CHANNEL_SETS`
- Url constant - `api/shop/oauth/%s/payment-options/%s` in `Payever\ExternalIntegration\Payments\PaymentsApiClient::SUB_URL_LIST_PAYMENT_OPTIONS`
- Url constant - `api/shop/oauth/%s/payment-options/variants/%s` in `Payever\ExternalIntegration\Payments\PaymentsApiClient::SUB_URL_LIST_PAYMENT_OPTIONS_VARIANTS`

## [2.10.0]

### Added
- property `phone` (`getPhone(): string|null`) in `Payever\ExternalIntegration\Payments\Http\MessageEntity\AddressEntity`
- property `email` (`getEmail(): string|null`) in `Payever\ExternalIntegration\Payments\Http\MessageEntity\AddressEntity`
- property `customerEmail` (`getCustomerEmail(): string|null`) in `Payever\ExternalIntegration\Payments\Http\MessageEntityRetrievePaymentResultEntity`

## [2.9.0]

### Added
- Method `setHttpClientRequestFailureLogLevel($logLevel = LogLevel::CRITICAL): self` in `Payever\ExternalIntegration\Core\CommonApiClient`
- Method `setHttpClientRequestFailureLogLevelOnce($logLevel): self` in `Payever\ExternalIntegration\Core\CommonApiClient`
- Method `setLogLevel($logLevel = LogLevel::CRITICAL): void` in `Payever\ExternalIntegration\Core\Http\Client\CurlClient`
- Method `setLogLevelOnce($logLevel): void` in `Payever\ExternalIntegration\Core\Http\Client\CurlClient`
### Changed
- Method `execute` in `Payever\ExternalIntegration\Core\Http\Client\CurlClient` to log exception with configured log level 
- Minor PHPDoc updates
- Short array syntax

## [2.8.0]

### Added
- Class `Payever\ExternalIntegration\CoreCommonProductsThirdPartyApiClient`
- Method `getBaseEntrypoint($staticBind = false): string` in `Payever\ExternalIntegration\Core\CommonApiClient`
- Url constant - `api/business/%s/connection/authorization/%s` in `Payever\ExternalIntegration\ThirdParty\ThirdPartyApiClient::SUB_URL_CONNECTION`
- Url constant - `api/business/%s/integration/%s` in `Payever\ExternalIntegration\ThirdParty\ThirdPartyApiClient::SUB_URL_INTEGRATION`
### Changed
- Method `close` in `Payever\ExternalIntegration\Core\Logger\FileLogger` to verify if file handle is resource
- Method `getBaseUrl` in `Payever\ExternalIntegration\Core\CommonApiClient` to reuse method `getBaseEntrypoint`
- Method `getAuthenticationURL` in `Payever\ExternalIntegration\Core\CommonApiClient` to reuse method `getBaseEntrypoint`
- Method `getListChannelSetsURL` in `Payever\ExternalIntegration\Core\CommonApiClient` to reuse method `getBaseEntrypoint`
- Method `getCurrenciesURL` in `Payever\ExternalIntegration\Core\CommonApiClient` to reuse method `getBaseEntrypoint`
- Class `Payever\ExternalIntegration\Inventory\InventoryApiClient` extended `Payever\ExternalIntegration\Core\CommonProductsThirdPartyApiClient`
- Class `Payever\ExternalIntegration\Products\ProductsApiClient` extended `Payever\ExternalIntegration\Core\CommonProductsThirdPartyApiClient`
- Class `Payever\ExternalIntegration\ThirdParty\ThirdPartyApiClient` extended `Payever\ExternalIntegration\Core\CommonProductsThirdPartyApiClient`
- Minor PHPDoc updates

## [2.7.0]

### Added
- "isRedirectMethod" parameter to list options response
- new endpoint /api/payment/submit

## [2.6.0]

### Added
- New payment action constant - `refund` in `Payever\ExternalIntegration\Payments\Action\ActionDeciderInterface::ACTION_REFUND`
- method `isCancelAllowed($paymentId, $throwException = true): bool` in `Payever\ExternalIntegration\Payments\Action\ActionDecider`
- method `isRefundAllowed($paymentId, $throwException = true): bool` in `Payever\ExternalIntegration\Payments\Action\ActionDecider`
- method `isShippingAllowed($paymentId, $throwException = true): bool` in `Payever\ExternalIntegration\Payments\Action\ActionDecider`

### Changed
- Payment action constant `return` marked as deprecated in `Payever\ExternalIntegration\Payments\Action\ActionDeciderInterface::ACTION_RETURN`
- Method `isActionAllowed` consider old `return` and new `refund` payment actions in `Payever\ExternalIntegration\Payments\Action\ActionDecider`
- Minor PHPDoc updates

## [2.5.9]

### Added
- property `transactionId` (`getTransactionId(): string|null`) in `Payever\ExternalIntegration\Payments\Http\MessageEntity\PaymentDetailsEntity`

## [2.5.8]

### Fixed
- typo in NotificationResult.php#L145
- added annotations in NotificationRequestEntity

## [2.5.7]

### Added
- "downPayment" parameter to retrieve response

## [2.5.6]

### Added
- New payment method constant - `instant_payment` in `Payever\ExternalIntegration\Payments\Enum\PaymentMethod::METHOD_INSTANT_PAYMENT`

### Changed
- Updated readme with more usage examples

## [2.5.5]

### Changed
- Method `getSku(): string` is falling back to product UUID when SKU is empty in `Payever\ExternalIntegration\Products\Http\RequestEntity\ProductRequestEntity`

## [2.5.4]

### Added
- method `isVariant(): boolean` in `Payever\ExternalIntegration\Products\Http\RequestEntity\ProductRequestEntity`
- property `parent` (`getParent(): string|null`) in `Payever\ExternalIntegration\Products\Http\RequestEntity\ProductRequestEntity`
- property `product` (`getProduct(): string|null`) in `Payever\ExternalIntegration\Products\Http\RequestEntity\ProductRequestEntity`

## [2.5.3]

### Changed
- Added plugin and CMS version into `\Payever\ExternalIntegration\Plugins\PluginsApiClient::getCommands` API request

## [2.5.2]

### Changed
- method `\Payever\ExternalIntegration\ThirdParty\Action\InwardActionProcessor::process` now returns `\Payever\ExternalIntegration\ThirdParty\Action\ActionResult` instead of `void`

## [2.5.1]

### Added
- method `getUnderscoreName(): string` in `\Payever\ExternalIntegration\Products\Http\MessageEntity\ProductVariantOptionEntity`
- property `vatRate` (`setVatRate(float $vatRate): static`, `getVatRate(): float`) in `Payever\ExternalIntegration\Products\Http\RequestEntity\ProductRequestEntity`

### Changed
- Minor PHPDoc updates


## [2.5.0]

### Added
- class `Payever\ExternalIntegration\Products\Http\MessageEntity\ProductVariantOptionEntity`
- class `Payever\ExternalIntegration\ThirdParty\Action\OutwardActionProcessor` for CMS -> payever synchronization actions 
- class `Payever\ExternalIntegration\ThirdParty\Action\BidirectionalActionProcessor` for convenient handling of bidirectional sync
- method `addOption(\Payever\ExternalIntegration\Products\Http\MessageEntity\ProductVariantOptionEntity $option): static` in `Payever\ExternalIntegration\Products\Http\RequestEntity\ProductRequestEntity`
- property `general` (`setGeneral(bool $general): static`, `getGeneral(): bool`) in `Payever\ExternalIntegration\Products\Http\MessageEntity\ProductShippingEntity`
- property `options` (`setOptions(array $options): static`, `getOptions(): \Payever\ExternalIntegration\Products\Http\MessageEntity\ProductVariantOptionEntity[]`) for product variant options in `Payever\ExternalIntegration\Products\Http\RequestEntity\ProductRequestEntity`

### Changed
- class `Payever\ExternalIntegration\ThirdParty\Action\ActionRequestProcessor` renamed to `Payever\ExternalIntegration\ThirdParty\Action\InwardActionProcessor`
- class `\Payever\ExternalIntegration\ThirdParty\Enum\Action` renamed to `\Payever\ExternalIntegration\ThirdParty\Enum\ActionEnum`
- class `\Payever\ExternalIntegration\ThirdParty\Enum\Direction` renamed to `\Payever\ExternalIntegration\ThirdParty\Enum\DirectionEnum`
- method `Payever\ExternalIntegration\ThirdParty\Action\InwardActionProcessor::processActionRequest` renamed to `Payever\ExternalIntegration\ThirdParty\Action\InwardActionProcessor::process`
- `enabled` property renamed to `active` (`setActive(bool $active)`, `getActive(): bool`) in `Payever\ExternalIntegration\Products\Http\RequestEntity\ProductRequestEntity`
- `hidden` property renamed to `onSales` (`setOnSales(bool $onSales)`, `getOnSales(): bool` )in `Payever\ExternalIntegration\Products\Http\RequestEntity\ProductRequestEntity`

### Removed
- property `inventoryTrackingEnabled` with setter and getter in `Payever\ExternalIntegration\Products\Http\RequestEntity\ProductRequestEntity`


## [2.4.0]

### Added
- class `Payever\ExternalIntegration\Payments\Converter\PaymentOptionConverter` to convert variant-based payment options response into classic one
  -  Example of converting variant-based options into classic ones:
    ```php
    use Payever\ExternalIntegration\Payments\PaymentsApiClient;
    use Payever\ExternalIntegration\Payments\Converter\PaymentOptionConverter;
    use Payever\ExternalIntegration\Payments\Http\ResponseEntity\ListPaymentOptionsWithVariantsResponse;
    
    $paymentsApiClient = new PaymentsApiClient();
    /** @var ListPaymentOptionsWithVariantsResponse $withVariants */
    $withVariants = $paymentsApiClient->listPaymentOptionsWithVariantsRequest([], 'business-uuid')->getResponseEntity();
    $convertedOptions = PaymentOptionConverter::convertPaymentOptionVariants($withVariants->getResult());
    
    foreach ($convertedOptions as $paymentOption) {
        $methodCode = $paymentOption->getPaymentMethod();
        $variantId = $paymentOption->getVariantId();
        $variantName = $paymentOption->getVariantName();
    }
    ```
- method `listPaymentOptionsWithVariantsRequest` in `Payever\ExternalIntegration\Payments\PaymentsApiClient` to retrieve payment options with variants
- property `variantId` (`setVariantId`, `getVariantId`) in `Payever\ExternalIntegration\Payments\Http\RequestEntity\CreatePaymentRequest`, you can set specific payment option variant by calling `->setVariantId($variantId)`

