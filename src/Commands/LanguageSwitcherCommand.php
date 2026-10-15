<?php

namespace Abdiwaahid\LanguageSwitcher\Commands;

use Abdiwaahid\LanguageSwitcher\Facades\LanguageSwitcher;
use Illuminate\Console\Command;

class LanguageSwitcherCommand extends Command
{
    public $signature = 'language-switcher';

    public $description = 'Display the current locale and the configured languages';

    public function handle(): int
    {
        $this->info('Current locale: '.LanguageSwitcher::get());
        $this->newLine();

        $this->table(
            ['Locale', 'Language'],
            LanguageSwitcher::languages(true)
                ->map(fn (string $name, string $locale): array => [$locale, $name])
                ->values()
                ->all(),
        );

        return self::SUCCESS;
    }
}
