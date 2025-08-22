<?php

namespace Abdiwaahid\LanguageSwitcher\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Abdiwaahid\LanguageSwitcher\LanguageSwitcher
 */
class LanguageSwitcher extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Abdiwaahid\LanguageSwitcher\LanguageSwitcher::class;
    }
}
