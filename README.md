# Simple and Flexible Language Switcher for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/abdiwaahid/language-switcher.svg?style=flat-square)](https://packagist.org/packages/abdiwaahid/language-switcher)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/abdiwaahid/language-switcher/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/abdiwaahid/language-switcher/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/abdiwaahid/language-switcher/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/abdiwaahid/language-switcher/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/abdiwaahid/language-switcher.svg?style=flat-square)](https://packagist.org/packages/abdiwaahid/language-switcher)

A simple language switcher for your Laravel applications. This package provides an easy way to allow your users to switch between different languages, with support for both session and cache drivers to store the selected locale. It also includes a ready-to-use Blade component for a seamless frontend integration.

## Features
*   **Easy Language Switching:** A straightforward way to let users change their preferred language.
*   **Multiple Drivers:** Supports both `session` and `cache` drivers for storing the user's selected language.
*   **User-Aware Caching:** When using the `cache` driver, the locale is cached specifically for each authenticated user.
*   **Facade for Convenience:** A clean and simple facade for easy interaction with the package's functionality.

## Installation

You can install the package via composer:

```bash
composer require abdiwaahid/language-switcher
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
	    'so' => 'Somali',
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

Finally, to use the provided CSS and JavaScript for the Blade component, publish the assets:

```bash
php artisan vendor:publish --tag="language-switcher-assets"
```

This will place a stylesheet and a script in your `public/vendor/language-switcher` directory.

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
or you can simply configure the languages in the `AppServiceProvider`:

```php
public function boot(): void
{
    LanguageSwitcher::configureLanguages([
        'en' => 'English',
        'es' => 'Spanish',
        'fr' => 'French',
    ]);
}
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
### 3. Add Styles and Scripts
For the dropdown component to function and look its best, include the published assets in your main layout file (`resources/views/layouts/app.blade.php` or similar).

The package provides two helpful Blade directives for this:

```blade
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    ...
    @languageSwitcherStyles
</head>
<body>
    ...
    <header>
        <nav>
            {{-- Your navigation --}}
            <x-language-switcher::language-switcher />
        </nav>
    </header>
    ...
    @languageSwitcherScripts
</body>
</html>
```

### 4. Use the Blade Component
The package comes with a ready-to-use Blade component to display the language switcher in your views. You can use it like this:
```blade
<x-language-switcher::language-switcher />
```
This will render a dropdown with the list of available languages. When a user clicks on a language, it will switch the application's locale and store it in the configured driver.

### 5. Usage with FilamentPHP

To integrate the language switcher with a [FilamentPHP](https://filamentphp.com/) admin panel, you can register the component and its assets within the service provider.

First, make sure you have published the package assets:
```bash
php artisan vendor:publish --tag="language-switcher-assets"```

Then, in the `register` method of your service provider, add the following:

```php
use Abdiwaahid\LanguageSwitcher\Facades\LanguageSwitcher;
use Filament\Facades\Filament;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Filament\View\PanelsRenderHook;

public function register(): void
{
    // Register the language switcher assets
    FilamentAsset::register([
        Css::make('language-switcher-css', asset('vendor/language-switcher/main.css')),
        Js::make('language-switcher-js', asset('vendor/language-switcher/index.js')),
    ], 'abdiwaahid/language-switcher');

    // Configure the languages you want to support
    LanguageSwitcher::configureLanguages([
        'so' => 'Somali',
        'en' => 'English',
        'ar' => 'Arabic',
    ]);

    // Render the component in the user menu
    Filament::registerRenderHook(
        PanelsRenderHook::USER_MENU_BEFORE,
        fn () => view('language-switcher::components.language-switcher')
    );
}
```

This will:
1.  Load the necessary CSS and JavaScript for the dropdown component.
2.  Configure the available languages for the switcher.
3.  Render the language switcher component right before the default user menu in the Filament panel.


## Advanced Usage
### Facade

The package provides a `LanguageSwitcher` facade for more granular control.

**Set the current locale:**
This will update the locale in the configured storage driver (session or cache).

```php
use Abdiwaahid\LanguageSwitcher\Facades\LanguageSwitcher;

LanguageSwitcher::set('fr');
```

**Get the current locale:**

This retrieves the locale from the storage driver.

```php
$currentLocale = LanguageSwitcher::get(); // returns 'fr'
```

**Get available languages:**

This returns a collection of all configured languages, excluding the current one. This is useful for building a custom language switcher UI.

```php
$languages = LanguageSwitcher::languages();
```

### Driver Configuration

In the `config/language-switcher.php` file, you can choose the storage driver.

-   `session`: (Default) The locale is stored in the user's session. This is suitable for most web applications.
-   `cache`: The locale is stored in your application's cache. This can be useful for applications that don't use traditional sessions. The cache key is automatically generated based on the authenticated user's ID or the guest's IP address.

```php
// config/language-switcher.php
'driver' => 'cache', // or 'session'
```

### Customization

If you need to modify the look and feel of the language switcher, you can publish the views:

```bash
php artisan vendor:publish --tag="language-switcher-views"
```

The view files will be located in `resources/views/vendor/language-switcher`. You can edit them as you see fit.

You can also publish the translation files to customize the language names displayed in the dropdown for different locales:

```bash
php artisan vendor:publish --tag="language-switcher-translations"
```

This will create translation files in `resources/lang/vendor/language-switcher`.

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
