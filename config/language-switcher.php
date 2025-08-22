<?php

// config for Abdiwaahid/LanguageSwitcher
return [

    // 'session' or 'cache'
    'driver' => 'session',

    // The guard to use for authenticated users.
    // If null, will use the default guard.
    'guard' => null,

    // The key used in the storage driver.
    'key' => 'locale_',

    'languages' => [
        'en' => 'English',
        'ar' => 'Arabic',
    ],
];
