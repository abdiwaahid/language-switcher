<?php

beforeEach(function () {
    config()->set('language-switcher.driver', 'session');
    config()->set('language-switcher.languages', [
        'en' => 'English',
        'fr' => 'French',
    ]);
});

it('renders the language switcher component', function () {
    $this->blade('<x-language-switcher::language-switcher />')
        ->assertSee('language-switcher-dropdown')
        ->assertSee('French')
        ->assertDontSee('English');
});

it('renders the flag fallback when the asset is not published', function () {
    $this->blade('<x-language-switcher::flag language="gb" />')
        ->assertSee('GB');
});
