# Simple and Flexible Language Switcher for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/abdiwaahid/language-switcher.svg?style=flat-square)](https://packagist.org/packages/abdiwaahid/language-switcher)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/abdiwaahid/language-switcher/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/abdiwaahid/language-switcher/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/abdiwaahid/language-switcher/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/abdiwaahid/language-switcher/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/abdiwaahid/language-switcher.svg?style=flat-square)](https://packagist.org/packages/abdiwaahid/language-switcher)

A simple language switcher for your Laravel applications. This package provides an easy way to allow your users to switch between different languages, with support for both session and cache drivers to store the selected locale. It also includes a ready-to-use Blade component for a seamless frontend integration.

## Features
*   **Easy Language Switching:** A straightforward way to let users change their preferred language.
*   **Multiple Drivers:** Supports both `session` and `cache` drivers for storing the user's selected language.
*   **User-Aware Caching:** When using the `cache` driver, the locale is cached specifically for each authenticated user or fallback to IP address for guests.
*   **Facade for Convenience:** A clean and simple facade for easy interaction with the package's functionality.
*   **Middleware:** Automatically sets the application's locale on every request based on the user's preference.
*   **Blade Component:** A ready-to-use and customizable Blade component for a quick and easy frontend implementation.
*   **Easy Configuration:** A simple configuration file to manage your languages and other options.

## Installation

You can install the package via composer:

```bash
composer require abdiwaahid/language-switcher
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="language-switcher-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="language-switcher-config"
```

This is the contents of the published config file:

```php
return [
    // 'session' or 'cache'
    'driver' => 'session',

    // The guard to use for authenticated users.
    // If null, will use the default guard.
    'guard' => null,

    // The key used in the storage driver.
    'key' => 'locale_',

    'languages' => [
        ....
    ],
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="language-switcher-views"
```


You can also publish the translation files to add support for more languages or customize the existing ones:

```bash
php artisan vendor:publish --tag="language-switcher-translations"
```

## Usage

### 1. Configure Your Languages
First, you need to define the languages you want to support in the `config/language-switcher.php` file. For example:

```php
'languages' => [
    'en' => 'English',
    'es' => 'Spanish',
    'fr' => 'French',
],
```
### 2. Add the Middleware
The package automatically registers the middleware for you. but if you want to add it manually, you can register it manually in your `bootstrap/app.php` file:

```php
    ...
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->appendToGroup('web', [
            \Abdiwaahid\LanguageSwitcher\Http\Middleware\LanguageSwitcherMiddleware::class,
        ]);
    });
```
### 3. Use the Blade Component
The package comes with a ready-to-use Blade component to display the language switcher in your views. You can use it like this:
```blade
<x-language-switcher::language-switcher />
```
This will render a dropdown with the list of available languages. When a user clicks on a language, it will switch the application's locale and store it in the configured driver.

### 4. Manually Switch Languages
You can manually switch languages using the `LanguageSwitcher` facade:
```php
use Abdiwaahid\LanguageSwitcher\Facades\LanguageSwitcher;

LanguageSwitcher::set('so');
```

To get the current locale:

```php
$currentLocale = LanguageSwitcher::get();
```

To get the list of available languages (excluding the current one):

```php
$languages = LanguageSwitcher::languages();
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Abdiwaahid](https://github.com/abdiwaahid)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
