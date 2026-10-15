<?php

namespace Abdiwaahid\LanguageSwitcher;

use Abdiwaahid\LanguageSwitcher\Commands\LanguageSwitcherCommand;
use Abdiwaahid\LanguageSwitcher\Http\Middleware\LanguageSwitcherMiddleware;
use Illuminate\Contracts\Http\Kernel as HttpKernel;
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
            ...$this->getLanguageFlagsToPublish(),
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

        $this->registerMiddleware();
    }

    private function registerMiddleware(): void
    {
        // Resolve the HTTP kernel before touching the router's middleware groups.
        // Since Laravel 11 the default groups are synced to the router from the
        // kernel's `withMiddleware` configuration, which would otherwise
        // overwrite any middleware pushed onto the `web` group during boot.
        $this->app->make(HttpKernel::class);

        $this->app->make(Router::class)
            ->pushMiddlewareToGroup('web', LanguageSwitcherMiddleware::class);
    }

    private function getLanguageFlagsToPublish(): array
    {
        $languages = LanguageSwitcher::languages(true);
        $array = [];

        foreach (array_keys($languages->all()) as $language) {
            $source = __DIR__.'/../resources/assets/img/flags/'.$language.'.png';

            if (! file_exists($source)) {
                continue;
            }

            $array[$source] = public_path('vendor/language-switcher/flags/'.$language.'.png');
        }

        return $array;
    }
}
