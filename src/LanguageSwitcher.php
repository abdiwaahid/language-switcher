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
        $key = static::getKey();
        Cache::forever($key, $locale);

        return $locale;
    }

    public static function get()
    {
        return Cache::get(static::getKey(), app()->getLocale());
    }

    public static function getKey(): string
    {
        $guard = config('language-switcher.guard');
        $key = config('language-switcher.key');
        if ($guard) {
            return Auth::check() ? $key.auth($guard)->id() : $key.request()->ip();
        }

        return $key.request()->ip();
    }

    public static function languages()
    {
        return collect(config('language-switcher.languages'))->filter(fn ($name, $locale) => $locale !== static::get());
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
