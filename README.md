# PHP SDK for payever Payments

This repository contains the open source PHP SDK that allows you to access payever from your PHP app.

## Requirements

* [PHP 5.4.0 and later](http://www.php.net/)

## Documentation

https://getpayever.com/developer/api-documentation/

## Installation

You can use **Composer** or **install manually**

### Composer

The preferred method is via [composer](https://getcomposer.org). Follow the
[installation instructions](https://getcomposer.org/doc/00-intro.md) if you do not already have
composer installed.

Once composer is installed, execute the following command in your project root to install this library:

```sh
composer require payever/sdk-php
```

### Manual Installation

Alternatively you can download the package in its entirety. The [Releases](../../releases) page lists all stable versions.

Uncompress the zip file you download, and include the autoloader in your project:

```php
require_once '/path/to/sdk-php/lib/Payever/ExternalIntegration/Core/Engine.php';
```

## License

Please see the [license file](LICENSE) for more information.