<?php

use Illuminate\Support\Facades\Route;
use Abdiwaahid\LanguageSwitcher\LanguageSwitcher;

Route::get('/language-switcher/switch/{locale}', function ($locale) {
    $locale = LanguageSwitcher::set($locale);
    LanguageSwitcher::switch($locale);
    return redirect()->back();
})->name('language-switcher.switch');