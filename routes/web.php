<?php

use Abdiwaahid\LanguageSwitcher\LanguageSwitcher;
use Illuminate\Support\Facades\Route;

Route::get('/language-switcher/switch/{locale}', function ($locale) {
    $locale = LanguageSwitcher::set($locale);
    LanguageSwitcher::switch($locale);

    return redirect()->back();
})->name('language-switcher.switch');
