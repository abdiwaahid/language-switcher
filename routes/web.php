<?php

use Abdiwaahid\LanguageSwitcher\Http\Controllers\LanguageSwitcherController;
use Illuminate\Support\Facades\Route;

Route::get('/language-switcher/switch/{locale}', LanguageSwitcherController::class)->name('language-switcher.switch');
