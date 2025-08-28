@props(['language'])
@php
    $path = public_path('vendor/language-switcher/flags/'.$language.'.png');
    $fileExists = file_exists($path);
@endphp

@if ($fileExists)
    <img id="language-switcher-flag" src="{{ asset('vendor/language-switcher/flags/'.$language.'.png') }}" alt="{{ $language }}">
@else
    <span id="language-switcher-flag">{{ str($language)->upper() }}</span>
@endif