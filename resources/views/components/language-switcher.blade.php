@php
    $languages = LanguageSwitcher::languages();
    $currentLanguage = LanguageSwitcher::get();
@endphp

<x-language-switcher::dropdown>
    <x-slot name="trigger">
        <button type="button">
            {{ str($currentLanguage)->upper() }}
        </button>
    </x-slot>
    <div name="content">
        @foreach ($languages as $language => $name)
            <x-language-switcher::dropdown.item href="{{ route('language-switcher.switch', $language) }}">
                {{ LanguageSwitcher::translationKeyFallback('language-switcher::language-switcher.'.$language,[],$name) }}
            </x-language-switcher::dropdown.item>
        @endforeach
    </div>
</x-language-switcher::dropdown>
