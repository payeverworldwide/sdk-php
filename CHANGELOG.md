# Changelog

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

