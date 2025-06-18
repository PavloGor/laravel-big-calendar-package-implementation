<?php

namespace OpenHands\BigCalendar\Commands;

use Illuminate\Console\Command;
use OpenHands\BigCalendar\Models\CalendarUser;

class InstallBigCalendarCommand extends Command
{
    public $signature = 'big-calendar:install {--seed : Seed the database with sample data}';

    public $description = 'Install Big Calendar package';

    public function handle(): int
    {
        $this->info('Installing Big Calendar package...');

        // Publish migrations
        $this->call('vendor:publish', [
            '--provider' => 'OpenHands\BigCalendar\BigCalendarServiceProvider',
            '--tag' => 'big-calendar-migrations',
        ]);

        // Run migrations
        $this->info('Running migrations...');
        $this->call('migrate');

        // Publish config
        $this->call('vendor:publish', [
            '--provider' => 'OpenHands\BigCalendar\BigCalendarServiceProvider',
            '--tag' => 'big-calendar-config',
        ]);

        // Seed data if requested
        if ($this->option('seed')) {
            $this->info('Seeding sample data...');
            $this->seedSampleData();
        }

        $this->info('Big Calendar package installed successfully!');
        $this->line('');
        $this->line('API endpoints available at:');
        $this->line('- GET /api/big-calendar/events');
        $this->line('- POST /api/big-calendar/events');
        $this->line('- GET /api/big-calendar/users');
        $this->line('');
        $this->line('For more information, visit: https://github.com/openhands/laravel-big-calendar');

        return self::SUCCESS;
    }

    private function seedSampleData(): void
    {
        // Create sample users
        $users = [
            [
                'name' => 'Leonardo Ramos',
                'email' => 'leonardo@example.com',
                'is_active' => true,
            ],
            [
                'name' => 'Michael Doe',
                'email' => 'michael@example.com',
                'is_active' => true,
            ],
            [
                'name' => 'Alice Johnson',
                'email' => 'alice@example.com',
                'is_active' => true,
            ],
            [
                'name' => 'Robert Smith',
                'email' => 'robert@example.com',
                'is_active' => true,
            ],
        ];

        foreach ($users as $userData) {
            CalendarUser::firstOrCreate(
                ['email' => $userData['email']],
                $userData
            );
        }

        $this->info('Sample users created successfully!');
    }
}
