<?php

use Abdiwaahid\LanguageSwitcher\Facades\LanguageSwitcher;
use Illuminate\Support\Facades\Route;

beforeEach(function () {
    app()->setLocale('en');

    config()->set('language-switcher.languages', [
        'en' => 'English',
        'fr' => 'French',
    ]);
});

it('switches and stores the locale through the route', function () {
    config()->set('language-switcher.driver', 'session');

    $this->get(route('language-switcher.switch', 'fr'))
        ->assertRedirect();

    expect(LanguageSwitcher::get())->toBe('fr');
});

it('applies the stored locale through the middleware', function () {
    Route::get('/locale-check', fn () => app()->getLocale())->middleware('web');

    config()->set('language-switcher.driver', 'session');

    $this->withSession([config('language-switcher.key') => 'fr'])
        ->get('/locale-check')
        ->assertSee('fr');
});
