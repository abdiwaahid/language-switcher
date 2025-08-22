<?php

namespace Abdiwaahid\LanguageSwitcher\Commands;

use Illuminate\Console\Command;

class LanguageSwitcherCommand extends Command
{
    public $signature = 'language-switcher';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
