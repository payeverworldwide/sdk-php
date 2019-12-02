
# 2.4.0

**Additions / Changes**

* Class `Payever\ExternalIntegration\Payments\PaymentsApiClient` has new method 
`listPaymentOptionsWithVariantsRequest` to retrieve payment options with variants.
* Class `Payever\ExternalIntegration\Payments\Http\RequestEntity\CreatePaymentRequest` has new property `variantId` (`setVariantId`, `getVariantId`), you can set specific payment option variant by callint `->setVariantId($variantId)`.
* New class `Payever\ExternalIntegration\Payments\Converter\PaymentOptionConverter` to convert variant-based payment options response into classic one.
* Example of converting variant-based options into classic ones:
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
