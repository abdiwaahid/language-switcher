<?php

use Abdiwaahid\LanguageSwitcher\Facades\LanguageSwitcher;

beforeEach(function () {
    app()->setLocale('en');

    config()->set('language-switcher.languages', [
        'en' => 'English',
        'fr' => 'French',
        'so' => 'Somali',
    ]);
});

it('stores and retrieves the locale using the session driver', function () {
    config()->set('language-switcher.driver', 'session');

    LanguageSwitcher::set('fr');

    expect(LanguageSwitcher::get())->toBe('fr');
});

it('stores and retrieves the locale using the cache driver', function () {
    config()->set('language-switcher.driver', 'cache');

    LanguageSwitcher::set('so');

    expect(LanguageSwitcher::get())->toBe('so');
});

it('switches the application locale', function () {
    LanguageSwitcher::switch('fr');

    expect(app()->getLocale())->toBe('fr');
});

it('returns all configured languages when including the current one', function () {
    expect(LanguageSwitcher::languages(true)->all())->toBe([
        'en' => 'English',
        'fr' => 'French',
        'so' => 'Somali',
    ]);
});

it('excludes the current language by default', function () {
    config()->set('language-switcher.driver', 'session');
    LanguageSwitcher::set('fr');

    expect(LanguageSwitcher::languages()->keys()->all())->toBe(['en', 'so']);
});

it('resolves translations and falls back when a key is missing', function () {
    expect(LanguageSwitcher::translationKeyFallback('language-switcher::language-switcher.so', [], 'Fallback'))
        ->toBe('Somali');

    expect(LanguageSwitcher::translationKeyFallback('language-switcher::language-switcher.missing', [], 'Fallback'))
        ->toBe('Fallback');
});

it('allows the languages to be configured at runtime', function () {
    LanguageSwitcher::configureLanguages(['de' => 'German']);

    expect(config('language-switcher.languages'))->toBe(['de' => 'German']);
});

it('lists the current locale and configured languages through the command', function () {
    $this->artisan('language-switcher')
        ->expectsOutputToContain('Current locale: en')
        ->expectsOutputToContain('French')
        ->assertSuccessful();
});
