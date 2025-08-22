@php
    $languages = LanguageSwitcher::languages();
    $currentLanguage = LanguageSwitcher::get();
@endphp

<x-language-switcher::dropdown>
    <x-slot name="trigger">
        <button class="ring-1 ring-purple-200 bg-purple-50 px-2 py-1  rounded" type="button">
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
