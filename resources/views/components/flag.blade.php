@props(['language'])
@php
    $path = base_path('vendor/abdiwaahid/language-switcher/resources/assets/img/flags/'.$language.'.png');
    $fileExists = file_exists($path);
    $file = $fileExists ? file_get_contents($path) : '';
@endphp

@if ($fileExists)
    <img id="language-switcher-flag" src="data:image/png;base64,{{ base64_encode($file) }}" alt="{{ $language }}">
@else
    <span id="language-switcher-flag">{{ str($language)->upper() }}</span>
@endif