# PHP SDK for payever Payments
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/payeverworldwide/sdk-php/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/payeverworldwide/sdk-php/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/payeverworldwide/sdk-php/badges/build.png?b=master)](https://scrutinizer-ci.com/g/payeverworldwide/sdk-php/build-status/master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/payeverworldwide/sdk-php/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)
[![Latest Stable Version](https://poser.pugx.org/payever/sdk-php/v/stable)](https://packagist.org/packages/payever/sdk-php)
[![Total Downloads](https://poser.pugx.org/payever/sdk-php/downloads)](https://packagist.org/packages/payever/sdk-php)
[![License](https://poser.pugx.org/payever/sdk-php/license)](https://packagist.org/packages/payever/sdk-php)

This repository contains the open source PHP SDK that allows you to access payever from your PHP app.

This library follows semantic versioning. Read more on [semver.org][1].

## Troubleshooting 

Feel free to open an [issue][7] if you found a bug.

## Requirements

* [PHP 5.4.0 and later][2]

## Documentation

https://getpayever.com/developer/api-documentation/

## Installation

You can use **Composer** or **install manually**

### Composer

The preferred method is via [composer][3]. Follow the
[installation instructions][4] if you do not already have
composer installed.

Once composer is installed, execute the following command in your project root to install this library:

```sh
composer require payever/sdk-php
```

### Manual Installation

Alternatively you can download the package entirety. The [Releases][5] page lists all stable versions.

Uncompress the zip file you download, and invoke the autoloader in your project:

```php
require_once '/path/to/sdk-php/lib/Payever/ExternalIntegration/Core/Engine.php';

\Payever\ExternalIntegration\Core\Engine::registerAutoloader();
```

## Examples

#### Create payment and obtain redirect url

```php

use Payever\ExternalIntegration\Core\ChannelSet;
use Payever\ExternalIntegration\Core\ClientConfiguration;
use Payever\ExternalIntegration\Payments\Enum\PaymentMethod;
use Payever\ExternalIntegration\Payments\PaymentsApiClient;
use Payever\ExternalIntegration\Payments\Http\RequestEntity\CreatePaymentRequest;

$clientId = 'your-oauth2-client-id';
$clientSecret = 'your-oauth2-client-secret';

$clientConfiguration = new ClientConfiguration();

$clientConfiguration
    ->setChannelSet(ChannelSet::CHANNEL_MAGENTO)
    ->setApiMode(ClientConfiguration::API_MODE_LIVE)
    ->setClientId($clientId)
    ->setClientSecret($clientSecret)
    ->setBusinessUuid('88888888-4444-4444-4444-121212121212')
;

$paymentsApiClient = new PaymentsApiClient($clientConfiguration);

$createPaymentEntity = new CreatePaymentRequest();

$createPaymentEntity
    ->setOrderId('1001')
    ->setAmount(100.5)
    ->setFee(10)
    ->setCurrency('EUR')
    ->setPaymentMethod(PaymentMethod::METHOD_SANTANDER_DE_INSTALLMENT)
    ->setSalutation('mr')
    ->setFirstName('John')
    ->setLastName('Doe')
    ->setCity('Hamburg')
    ->setCountry('DE')
    ->setZip('10111')
    ->setStreet('Awesome street, 10')
    ->setEmail('john.doe@example.com')
    ->setPhone('+450001122')
    ->setSuccessUrl('https://your.domain/success?paymentId=--PAYMENT-ID--')
    ->setCancelUrl('https://your.domain/checkout?reason=cancel')
    ->setFailureUrl('https://your.domain/checkout?reason=failure')
    ->setNoticeUrl('https://your.domain/async-payment-callback?paymentId=--PAYMENT-ID--')
;

try {
    $response = $paymentsApiClient->createPaymentRequest($createPaymentEntity);
    $responseEntity = $response->getResponseEntity();
    
    header(sprintf('Location: %s', $responseEntity->getRedirectUrl()), true);
    exit;
} catch (\Exception $exception) {
    echo $exception->getMessage();
}

```

## License

Please see the [license file][6] for more information.

[1]: http://semver.org
[2]: http://www.php.net/
[3]: https://getcomposer.org
[4]: https://getcomposer.org/doc/00-intro.md
[5]: ../../releases
[6]: LICENSE.md
[7]: ../../issues
