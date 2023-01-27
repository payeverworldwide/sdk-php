# PHP SDK for payever plugin interactions - internal, not for public use
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/payeverworldwide/sdk-php/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/payeverworldwide/sdk-php/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/payeverworldwide/sdk-php/badges/build.png?b=master)](https://scrutinizer-ci.com/g/payeverworldwide/sdk-php/build-status/master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/payeverworldwide/sdk-php/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)
[![Latest Stable Version](https://poser.pugx.org/payever/sdk-php/v/stable)](https://packagist.org/packages/payever/sdk-php)
[![Total Downloads](https://poser.pugx.org/payever/sdk-php/downloads)](https://packagist.org/packages/payever/sdk-php)
[![License](https://poser.pugx.org/payever/sdk-php/license)](https://packagist.org/packages/payever/sdk-php)

This repository contains the open source PHP SDK that allows you to access payever from your PHP app.

This library follows semantic versioning. Read more on [semver.org][1].

Please note: this SDK is used within the payever plugins. It is NOT suitable for custom API integrations. If you would like to integrate with us via API, please visit https://docs.payever.org/shopsystems/api and follow the instructions and code examples provided there. 

## Troubleshooting 

If you faced an issue you can contact us via official support channel - support@getpayever.com

## Requirements

* [PHP 5.4.0 and later][2]
* PHP cURL extension

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

Uncompress the zip file and invoke the autoloader in your project:

```php
require_once '/path/to/sdk-php/lib/Payever/ExternalIntegration/Core/Engine.php';

\Payever\ExternalIntegration\Core\Engine::registerAutoloader();
```

## Documentation

Raw HTTP API docs can be found here - https://docs.payever.org/shopsystems/api

### Enums

The are several list of fixed string values used inside API. For convenience they are represented as constants and grouped into classes.

* Core
    - [`ChannelSet`](lib/Payever/ExternalIntegration/Core/Enum/ChannelSet.php) - list of available payever API channels
* Payments
    - [`PaymentMethod`](lib/Payever/ExternalIntegration/Payments/Enum/PaymentMethod.php) - list of available payever payment methods
    - [`Status`](lib/Payever/ExternalIntegration/Payments/Enum/Status.php) - list of available payever payment statuses
* ThirdParty
    - [`ActionEnum`](lib/Payever/ExternalIntegration/ThirdParty/Enum/ActionEnum.php) - list of available actions (webhooks)
    - [`DirectionEnum`](lib/Payever/ExternalIntegration/ThirdParty/Enum/DirectionEnum.php) - list of available action directions
* Products
    - [`ProductTypeEnum`](lib/Payever/ExternalIntegration/Products/Enum/ProductTypeEnum.php) - list of available payever product types
* Plugins
    - [`PluginCommandNameEnum`](lib/Payever/ExternalIntegration/Plugins/Enum/PluginCommandNameEnum.php) - list of available plgin command types 

### API Clients

HTTP API communication with payever happens through API clients. There are several of them for different API categories:

- [`PaymentsApiClient`](#paymentsapiclient)
- [`ThirdPartyApiClient`](#thirdpartyapiclient)
- [`ProductsApiClient`](#productsapiclient)
- [`InventoryApiClient`](#inventoryapiclient)

Each one is described in details below.

#### Configuration

Each API client requires configuration object as the first argument of client's constructor. 
In order to get the valid configuration object you need to have valid API credentials:

- Client ID
- Client Secret
- Business UUID

Additionally, you need to tell which API channel you're using:

```php
use Payever\ExternalIntegration\Core\ClientConfiguration;
use Payever\ExternalIntegration\Core\Enum\ChannelSet;

$clientId = 'your-oauth2-client-id';
$clientSecret = 'your-oauth2-client-secret';
$businessUuid = '88888888-4444-4444-4444-121212121212';

$clientConfiguration = new ClientConfiguration();

$clientConfiguration
    ->setClientId($clientId)
    ->setClientSecret($clientSecret)
    ->setBusinessUuid($businessUuid)
    ->setChannelSet(ChannelSet::CHANNEL_MAGENTO)
    ->setApiMode(ClientConfiguration::API_MODE_LIVE)
;
```
NOTE: All examples below assume you have [`ClientConfiguration`](lib/Payever/ExternalIntegration/Core/ClientConfiguration.php) instantiated inside `$clientConfiguration` variable.

##### Logging

You can setup logging of all API interactions by providing [PSR-3](https://www.php-fig.org/psr/psr-3/) compatible logger instance.

In case if you don't have PSR-3 compatible logger at hand - this SKD contains simple file logger:
```php
use Psr\Log\LogLevel;
use Payever\ExternalIntegration\Core\Logger\FileLogger;

$logger = new FileLogger(__DIR__.'/payever.log', LogLevel::INFO);
$clientConfiguration->setLogger($logger);
```

#### PaymentsApiClient

This API client is used in all payment-related interactions. 

##### Create payment and obtain redirect url

```php
use Payever\ExternalIntegration\Payments\Enum\PaymentMethod;
use Payever\ExternalIntegration\Payments\PaymentsApiClient;
use Payever\ExternalIntegration\Payments\Http\RequestEntity\CreatePaymentRequest;

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
    ->setCart([
        [
            'name'        => 'test',
            'sku'         => 'test',
            'identifier'  => 'test',
            'price'       => 100.5,
            'vatRate'     => 0,
            'quantity'    => 1,
        ]
    ])
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

##### Retrieve payment details by id

```php
use Payever\ExternalIntegration\Payments\PaymentsApiClient;
use Payever\ExternalIntegration\Payments\Http\MessageEntity\RetrievePaymentResultEntity;

$paymentId = '--PAYMENT-ID--';
$paymentsApiClient = new PaymentsApiClient($clientConfiguration);

try {
    $response = $paymentsApiClient->retrievePaymentRequest($paymentId);
    /** @var RetrievePaymentResultEntity $payment */
    $payment = $response->getResponseEntity()->getResult();
    $status = $payment->getStatus();
} catch(\Exception $exception) {
    echo $exception->getMessage();
}
```

##### Cancel the payment by id

```php
use Payever\ExternalIntegration\Payments\PaymentsApiClient;
use Payever\ExternalIntegration\Payments\Action\ActionDecider;

$paymentId = '--PAYMENT-ID--';
$paymentsApiClient = new PaymentsApiClient($clientConfiguration);
$actionDecider = new ActionDecider($paymentsApiClient);

try {
    if ($actionDecider->isActionAllowed($paymentId, ActionDecider::ACTION_CANCEL, false)) {
        $paymentsApiClient->cancelPaymentRequest($paymentId);
    }
} catch(\Exception $exception) {
    echo $exception->getMessage();
}
```

##### Trigger Santander shipping-goods payment action 

```php
use Payever\ExternalIntegration\Payments\PaymentsApiClient;
use Payever\ExternalIntegration\Payments\Action\ActionDecider;

$paymentId = '--PAYMENT-ID--';
$paymentsApiClient = new PaymentsApiClient($clientConfiguration);
$actionDecider = new ActionDecider($paymentsApiClient);

try {
    if ($actionDecider->isActionAllowed($paymentId, ActionDecider::ACTION_SHIPPING_GOODS, false)) {
        $paymentsApiClient->shippingGoodsPaymentRequest($paymentId);
    }
} catch(\Exception $exception) {
    echo $exception->getMessage();
}
```


#### ThirdPartyApiClient

This client can be used to initiate webhook-based data flow between your system and payever.
As of now, only product and inventory webhooks are supported. 

How it works:
- generate a unique string (`externalId`) to identify yourself inside payever system; 
- create a data subscription with a list of webhooks you wish to consume;
- whenever specific event happens inside payever system you will receive an HTTP request to your webhook URL;

##### Subscribe

```php
use Payever\ExternalIntegration\Core\PseudoRandomStringGenerator;
use Payever\ExternalIntegration\ThirdParty\Enum\ActionEnum;
use Payever\ExternalIntegration\ThirdParty\ThirdPartyApiClient;
use Payever\ExternalIntegration\ThirdParty\Http\RequestEntity\SubscriptionRequestEntity;
use Payever\ExternalIntegration\ThirdParty\Http\MessageEntity\SubscriptionActionEntity;

$tmpApiClient = new ThirdPartyApiClient($clientConfiguration);
$randomSource = new PseudoRandomStringGenerator();
$subscriptionEntity = new SubscriptionRequestEntity();

// save it in persistent storage for future use 
$externalId = $randomSource->generate();
$subscriptionEntity->setExternalId($externalId);

$actionEntity = new SubscriptionActionEntity();
// your webhook details
$actionEntity->setName(ActionEnum::ACTION_CREATE_PRODUCT)
    ->setUrl('https://my.shop.com/webhook/?action=create-product&token=' . $externalId)
    ->setMethod('POST');

$subscriptionEntity->addAction($actionEntity);

try {
    $tmpApiClient->subscribe($subscriptionEntity);
} catch(\Exception $exception) {
    echo $exception->getMessage();
}
```

You can find the full list of available webhooks [here](lib/Payever/ExternalIntegration/ThirdParty/Enum/ActionEnum.php).
 

##### Check subscription status

Useful when you need to check if your subscription is active or check the list of webhooks.

```php
use Payever\ExternalIntegration\ThirdParty\ThirdPartyApiClient;
use Payever\ExternalIntegration\ThirdParty\Http\RequestEntity\SubscriptionRequestEntity;
use Payever\ExternalIntegration\ThirdParty\Http\ResponseEntity\SubscriptionResponseEntity;

$tmpApiClient = new ThirdPartyApiClient($clientConfiguration);
$subscriptionEntity = new SubscriptionRequestEntity();
 
$externalId = ''; // retrieve it from your persistent storage
$subscriptionEntity->setExternalId($externalId);

try {
    $response = $tmpApiClient->getSubscriptionStatus($subscriptionEntity);
    /** @var SubscriptionResponseEntity $subscription */
    $subscription = $response->getResponseEntity(); 
    $id = $subscription->getId();
} catch(\Exception $exception) {
    echo $exception->getMessage();
}
```

##### Unsubscribe

If you want to stop receiving webhook updates - you would need to call "unsubscribe" method. 

```php
use Payever\ExternalIntegration\ThirdParty\ThirdPartyApiClient;
use Payever\ExternalIntegration\ThirdParty\Http\RequestEntity\SubscriptionRequestEntity;

$tmpApiClient = new ThirdPartyApiClient($clientConfiguration);
$subscriptionEntity = new SubscriptionRequestEntity();
 
$externalId = ''; // retrieve it from your persistent storage
$subscriptionEntity->setExternalId($externalId);

try {
    $tmpApiClient->unsubscribe($subscriptionEntity);
} catch(\Exception $exception) {
    echo $exception->getMessage();
}
```

##### Handling action (webhook) requests

Of course you can handle webhook requests manually, but there are several classes and interfaces for easier webhook handling.

You can define a class for each webhook type by implementing [`ActionHandlerInterface`](lib/Payever/ExternalIntegration/ThirdParty/Action/ActionHandlerInterface.php):
```php
use Payever\ExternalIntegration\ThirdParty\Action\ActionHandlerInterface;
use Payever\ExternalIntegration\ThirdParty\Action\ActionPayload;
use Payever\ExternalIntegration\ThirdParty\Action\ActionResult;
use Payever\ExternalIntegration\ThirdParty\Enum\ActionEnum;
use Payever\ExternalIntegration\Products\Http\RequestEntity\ProductRequestEntity;

class MyCreateProductActionHandler implements ActionHandlerInterface
{
  public function getSupportedAction()
  {
    return ActionEnum::ACTION_CREATE_PRODUCT; // Which webhook type this class intends to handle?
  }
  
  public function handle(ActionPayload $actionPayload, ActionResult $actionResult)
  {
    /** @var ProductRequestEntity $payeverProduct */
    $payeverProduct = $actionPayload->getPayloadEntity();

    if (!$payeverProduct->getSku()) {
      $actionResult->addError('Product must have SKU');
      
      return;
    }
    
    if (productExists()) {
      // TODO: update product inside your system
      $actionResult->incrementUpdated();
    } else {
      // TODO: create product inside you system
      $actionResult->incrementCreated();
    }
    
    // no need to handle exceptions here
  }
}
```

Once you created such handler classes for all webhooks, you can combine them into [`ActionHandlerPool`](lib/Payever/ExternalIntegration/ThirdParty/Action/ActionHandlerPool.php)
and use [`InwardActionProcessor`](lib/Payever/ExternalIntegration/ThirdParty/Action/InwardActionProcessor.php) to handle all the routines for you:
```php
use Psr\Log\LogLevel;
use Payever\ExternalIntegration\Core\Logger\FileLogger;
use Payever\ExternalIntegration\ThirdParty\Action\ActionHandlerPool;
use Payever\ExternalIntegration\ThirdParty\Action\InwardActionProcessor;
use Payever\ExternalIntegration\ThirdParty\Action\ActionResult;

$actionName = $_REQUEST['action'];
$token = $_REQUEST['token'];

if (!$actionName) {
    // respond with 400 HTTP status code
    exit;
}

$externalId = '';// retrieve from your persistent storage

if (!$token || $token !== $externalId) {
    // respond with 401 HTTP status code
    exit;
}

$logger = new FileLogger(__DIR__.'/payever.log', LogLevel::INFO);

try {
    $actionResult = new ActionResult();
    $actionHandlerPool = new ActionHandlerPool([
      new MyCreateProductActionHandler(),
      new MyUpdateProductActionHandler(),
      //...  
    ]);
    $actionProcessor = new InwardActionProcessor(
        $actionHandlerPool,
        $actionResult,
        $logger
    );

    $actionResult = $actionProcessor->process($actionName);

    echo (string) $actionResult;
    // respond with 200 status
} catch (\Exception $exception) {
    $logger->critical(sprintf('Webhook processing failed: %s', $exception->getMessage()));
    // respond with 500 status
}
```


#### ProductsApiClient

This client class is dependant on `ThirdPartyApiClient` and requires active third-party subscription with known `externalId`;

This API client can be used to create/update/delete (NOTE: "read" operation is not available atm) operations over payever products.
Please note that products between any external system and payever are identified by SKU field.

##### Create or update product
```php
use Payever\ExternalIntegration\Products\ProductsApiClient;
use Payever\ExternalIntegration\Products\Http\RequestEntity\ProductRequestEntity;

$productsApiClient = new ProductsApiClient($clientConfiguration);
$productEntity = new ProductRequestEntity();

$productEntity->setTitle('Awesome Product')
    ->setActive(true)
    ->setSku('AWSM1')
    ->setPrice(100.5)
    ->setCurrency('EUR')
    ->setDescription('Awesome product description')
    ->setImages([
        'https://my.shop.com/images/awsm1.png',
    ])
    ->setCategories([
        'Awesome Goods',
    ])
    ->setShipping([
        'width' => 1,
        'height' => 1,
        'length' => 1,
        'weight' => 2,
    ]);

$externalId = '';// retrieve it from your persistent storage
$productEntity->setExternalId($externalId);

try {
    $productsApiClient->createOrUpdateProduct($productEntity);
} catch(\Exception $exception) {
    echo $exception->getMessage();
}
```

##### Delete/remove product
```php
use Payever\ExternalIntegration\Products\ProductsApiClient;
use Payever\ExternalIntegration\Products\Http\RequestEntity\ProductRemovedRequestEntity;

$productsApiClient = new ProductsApiClient($clientConfiguration);
$productRemovedEntity = new ProductRemovedRequestEntity();
$productRemovedEntity->setSku('AWSM1');

$externalId = '';// retrieve it from your persistent storage
$productRemovedEntity->setExternalId($externalId);

try {
    $productsApiClient->removeProduct($productRemovedEntity);
} catch(\Exception $exception) {
    echo $exception->getMessage();
}
```

#### InventoryApiClient

This client class is dependent on `ThirdPartyApiClient` and requires active third-party subscription with known `externalId`;

This API client can be used to create/add/subtract (NOTE: "read" operation is not available atm) operations over payever inventory.
Please note that product inventory between any external system and payever are identified by SKU field.

##### Create product inventory record

"Create" operation can be done only once, all further "create" requests with the same SKU will be ignored. 
Use add/subtract operations to change the value of inventory once it created.

```php
use Payever\ExternalIntegration\Inventory\InventoryApiClient;
use Payever\ExternalIntegration\Inventory\Http\RequestEntity\InventoryCreateRequestEntity;

$inventoryApiClient = new InventoryApiClient($clientConfiguration);

$inventoryCreateEntity = new InventoryCreateRequestEntity();
$inventoryCreateEntity->setSku('AWSM1')
    ->setStock(15);

$externalId = '';// retrieve it from your persistent storage
$inventoryCreateEntity->setExternalId($externalId);

try {
    $inventoryApiClient->createInventory($inventoryCreateEntity);
} catch (Exception $exception) {
    echo $exception->getMessage();
}
```

##### Add (increase) inventory value
```php
use Payever\ExternalIntegration\Inventory\InventoryApiClient;
use Payever\ExternalIntegration\Inventory\Http\RequestEntity\InventoryChangedRequestEntity;

$inventoryApiClient = new InventoryApiClient($clientConfiguration);

$inventoryChangeEntity = new InventoryChangedRequestEntity();
$inventoryChangeEntity->setSku('AWSM1')
    ->setQuantity(5); // read as: +5 to existing value

$externalId = '';// retrieve it from your persistent storage
$inventoryChangeEntity->setExternalId($externalId);

try {
    $inventoryApiClient->addInventory($inventoryChangeEntity);
} catch (Exception $exception) {
    echo $exception->getMessage();
}
```

##### Subtract (decrease) inventory value
```php
use Payever\ExternalIntegration\Inventory\InventoryApiClient;
use Payever\ExternalIntegration\Inventory\Http\RequestEntity\InventoryChangedRequestEntity;

$inventoryApiClient = new InventoryApiClient($clientConfiguration);

$inventoryChangeEntity = new InventoryChangedRequestEntity();
$inventoryChangeEntity->setSku('AWSM1')
    ->setQuantity(3); // read as: -3 to existing value

$externalId = '';// retrieve it from your persistent storage
$inventoryChangeEntity->setExternalId($externalId);

try {
    $inventoryApiClient->subtractInventory($inventoryChangeEntity);
} catch (Exception $exception) {
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
