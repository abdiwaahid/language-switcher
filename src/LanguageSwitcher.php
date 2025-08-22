<?php

namespace Abdiwaahid\LanguageSwitcher;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Lang;

class LanguageSwitcher
{
    public static function switch($locale)
    {
        app()->setLocale($locale);
    }

    public static function set($locale)
    {
        $driver = config('language-switcher.driver', 'session');
        if ($driver === 'session') {
            return session()->put(static::getKey(), $locale);
        }else{
            Cache::forever(static::getKey(), $locale);
        }
        return $locale;
    }

    public static function get()
    {

        $driver = config('language-switcher.driver', 'session');
        if ($driver === 'session') {
            return session()->get(static::getKey(), app()->getLocale());
        }
        return Cache::get(static::getKey(), app()->getLocale());
    }

    public static function getKey(): string
    {
        $key = config('language-switcher.key', 'locale_');
        if (config('language-switcher.driver') === 'session') {
            return $key;
        }

        $guard = config('language-switcher.guard');
        if ($guard && Auth::guard($guard)->check()) {
            return $key . Auth::guard($guard)->id();
        }

        return $key . request()->ip();
    }

    public static function languages()
    {
        return collect(config('language-switcher.languages'))->filter(fn($name, $locale) => $locale !== static::get());
    }

    public static function translationKeyFallback($key, $params, $fallback)
    {
        return Lang::has($key) ? __($key, $params) : $fallback;
    }

    public static function configureLanguages(array $languages)
    {
        config([
            'language-switcher.languages' => $languages,
        ]);
    }
}
