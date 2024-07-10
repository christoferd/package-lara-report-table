<?php

namespace Christoferd\LaraReportTable;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
// use Christoferd\LaraReportTable\Commands\LaraReportTableCommand;

class LaraReportTableServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('package-lara-report-table')
            // ->hasConfigFile()
            ->hasViews();
            // ->hasCommand(LaraReportTableCommand::class);

        // Chris D. 8-Jul-2024 - Override Spatie automatic stuff coz it didn't work for me :(
        $dir = substr(__DIR__, 0, -4).'\\resources\\views';
        $this->loadViewsFrom($dir,$this->package->viewNamespace());
    }
}
