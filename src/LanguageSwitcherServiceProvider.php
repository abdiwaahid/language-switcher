<?php

namespace Abdiwaahid\LanguageSwitcher;

use Abdiwaahid\LanguageSwitcher\Commands\LanguageSwitcherCommand;
use Abdiwaahid\LanguageSwitcher\Http\Middleware\LanguageSwitcherMiddleware;
use Illuminate\Routing\Router;
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
        $router = $this->app->make(Router::class);
        $router->pushMiddlewareToGroup('web', LanguageSwitcherMiddleware::class);
    }
}
