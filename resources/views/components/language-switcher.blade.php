@php
    $languages = LanguageSwitcher::languages();
    $currentLanguage = LanguageSwitcher::get();
@endphp

<x-language-switcher::dropdown>
    <x-slot name="trigger">
        <button class="language-switcher-trigger">
            <x-language-switcher::flag :language="$currentLanguage" />
        </button>
    </x-slot>
    <div name="content">
        @foreach ($languages as $language => $name)
            <x-language-switcher::dropdown.item :href="route('language-switcher.switch', $language)">
                <x-language-switcher::flag :language="$language" />
                {{ LanguageSwitcher::translationKeyFallback('language-switcher::language-switcher.'.$language,[],$name) }}
            </x-language-switcher::dropdown.item>
        @endforeach
    </div>
</x-language-switcher::dropdown>