@props(['language'])
@php
    $path = public_path('vendor/language-switcher/flags/'.$language.'.png');
    $fileExists = file_exists($path);
@endphp

@if ($fileExists)
    <img class="language-switcher-flag" src="{{ asset('vendor/language-switcher/flags/'.$language.'.png') }}" alt="{{ $language }}">
@else
    <span class="language-switcher-flag">{{ str($language)->upper() }}</span>
@endif