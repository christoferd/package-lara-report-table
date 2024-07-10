<?php

namespace Christoferd\LaraReportTable\Commands;

use Illuminate\Console\Command;

class LaraReportTableCommand extends Command
{
    public $signature = 'lara-report-table';

    public $description = 'Nothing to see here';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
