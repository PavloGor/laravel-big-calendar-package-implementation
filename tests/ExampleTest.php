<?php

use OpenHands\BigCalendar\BigCalendar;
use OpenHands\BigCalendar\Models\CalendarEvent;
use OpenHands\BigCalendar\Models\CalendarUser;

it('can create calendar events', function () {
    $user = CalendarUser::factory()->create();

    $event = CalendarEvent::create([
        'title' => 'Test Event',
        'description' => 'Test Description',
        'start_date' => now(),
        'end_date' => now()->addHour(),
        'color' => 'blue',
        'user_id' => $user->id,
        'all_day' => false,
    ]);

    expect($event)->toBeInstanceOf(CalendarEvent::class);
    expect($event->title)->toBe('Test Event');
    expect($event->user_id)->toBe($user->id);
});

it('can use the BigCalendar facade', function () {
    $bigCalendar = new BigCalendar;

    expect($bigCalendar)->toBeInstanceOf(BigCalendar::class);
});

it('can filter events by date range', function () {
    $user = CalendarUser::factory()->create();

    // Create events in different months
    CalendarEvent::factory()->create([
        'user_id' => $user->id,
        'start_date' => '2024-01-15 10:00:00',
        'end_date' => '2024-01-15 11:00:00',
    ]);

    CalendarEvent::factory()->create([
        'user_id' => $user->id,
        'start_date' => '2024-02-15 10:00:00',
        'end_date' => '2024-02-15 11:00:00',
    ]);

    $events = CalendarEvent::inDateRange(
        \Carbon\Carbon::parse('2024-01-01'),
        \Carbon\Carbon::parse('2024-01-31')
    )->get();

    expect($events)->toHaveCount(1);
});
