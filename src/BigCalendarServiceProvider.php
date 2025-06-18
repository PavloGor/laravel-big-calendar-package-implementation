<?php

namespace OpenHands\BigCalendar;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use OpenHands\BigCalendar\Commands\InstallBigCalendarCommand;

class BigCalendarServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('big-calendar')
            ->hasConfigFile()
            ->hasMigrations([
                'create_calendar_users_table',
                'create_calendar_events_table'
            ])
            ->hasCommand(InstallBigCalendarCommand::class);
    }

    public function packageBooted()
    {
        // Register API routes
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
    }
}
