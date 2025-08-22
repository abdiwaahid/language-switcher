<?php

namespace Abdiwaahid\LanguageSwitcher;

use Abdiwaahid\LanguageSwitcher\Commands\LanguageSwitcherCommand;
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
}
