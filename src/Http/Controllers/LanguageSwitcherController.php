<?php

namespace Abdiwaahid\LanguageSwitcher\Http\Controllers;

use Abdiwaahid\LanguageSwitcher\Facades\LanguageSwitcher;

class LanguageSwitcherController
{
    public function __invoke($locale)
    {
        LanguageSwitcher::set($locale);

        return redirect()->back();
    }
}
