<?php

use Illuminate\Support\Facades\Route;
use Abdiwaahid\LanguageSwitcher\Http\Controllers\LanguageSwitcherController;

Route::get('/language-switcher/switch/{locale}', LanguageSwitcherController::class)->name('language-switcher.switch');
