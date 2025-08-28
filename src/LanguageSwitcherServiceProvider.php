<?php

namespace Abdiwaahid\LanguageSwitcher;

use Abdiwaahid\LanguageSwitcher\Commands\LanguageSwitcherCommand;
use Abdiwaahid\LanguageSwitcher\Http\Middleware\LanguageSwitcherMiddleware;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Blade;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LanguageSwitcherServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('language-switcher')
            ->hasConfigFile()
            ->hasViews()
            ->hasRoute('web')
            ->hasTranslations()
            ->hasCommand(LanguageSwitcherCommand::class);
    }

    public function packageBooted()
    {
        $this->publishes([
            __DIR__.'/../resources/assets/css/main.css' => public_path('vendor/language-switcher/main.css'),
            __DIR__.'/../resources/assets/js/index.js' => public_path('vendor/language-switcher/index.js'),
            __DIR__.'/../resources/assets/img/flags' => public_path('vendor/language-switcher/flags'),
        ], 'language-switcher-assets');

        Blade::directive('languageSwitcherStyles', function () {
            return <<<'HTML'
                <link rel="stylesheet" href="{{ asset('vendor/language-switcher/main.css') }}">
            HTML;
        });
        Blade::directive('languageSwitcherScripts', function () {
            return <<<'HTML'
                <script src="{{ asset('vendor/language-switcher/index.js') }}"></script>
            HTML;
        });

        $router = $this->app->make(Router::class);
        $router->pushMiddlewareToGroup('web', LanguageSwitcherMiddleware::class);
    }
}
