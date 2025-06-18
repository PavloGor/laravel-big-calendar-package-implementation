<?php

// config for OpenHands/BigCalendar
return [
    /*
    |--------------------------------------------------------------------------
    | Default Calendar View
    |--------------------------------------------------------------------------
    |
    | This option controls the default view when the calendar is loaded.
    | Supported: "month", "week", "day", "year", "agenda"
    |
    */
    'default_view' => 'month',

    /*
    |--------------------------------------------------------------------------
    | Available Event Colors
    |--------------------------------------------------------------------------
    |
    | Define the available colors for calendar events.
    |
    */
    'event_colors' => [
        'blue',
        'green', 
        'red',
        'yellow',
        'purple',
        'orange',
        'gray',
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Working Hours
    |--------------------------------------------------------------------------
    |
    | Define the default working hours for the calendar views.
    | Format: 24-hour format (0-23)
    |
    */
    'working_hours' => [
        'start' => 8,  // 8 AM
        'end' => 18,   // 6 PM
    ],

    /*
    |--------------------------------------------------------------------------
    | Visible Hours Range
    |--------------------------------------------------------------------------
    |
    | Define the visible hours range in day and week views.
    | Format: 24-hour format (0-23)
    |
    */
    'visible_hours' => [
        'start' => 6,  // 6 AM
        'end' => 22,   // 10 PM
    ],

    /*
    |--------------------------------------------------------------------------
    | Time Slot Duration
    |--------------------------------------------------------------------------
    |
    | Define the duration of each time slot in minutes.
    | Supported: 15, 30, 60
    |
    */
    'time_slot_duration' => 30,

    /*
    |--------------------------------------------------------------------------
    | Badge Variant
    |--------------------------------------------------------------------------
    |
    | Define the default badge variant for events.
    | Supported: "dot", "colored", "mixed"
    |
    */
    'badge_variant' => 'colored',

    /*
    |--------------------------------------------------------------------------
    | Enable Drag and Drop
    |--------------------------------------------------------------------------
    |
    | Enable or disable drag and drop functionality for events.
    |
    */
    'enable_drag_drop' => true,

    /*
    |--------------------------------------------------------------------------
    | API Route Prefix
    |--------------------------------------------------------------------------
    |
    | Define the prefix for API routes.
    |
    */
    'api_prefix' => 'api/big-calendar',

    /*
    |--------------------------------------------------------------------------
    | Middleware
    |--------------------------------------------------------------------------
    |
    | Define middleware to be applied to calendar routes.
    |
    */
    'middleware' => [
        'api',
        // 'auth:sanctum', // Uncomment if you want to protect routes
    ],

    /*
    |--------------------------------------------------------------------------
    | Pagination
    |--------------------------------------------------------------------------
    |
    | Define pagination settings for events.
    |
    */
    'pagination' => [
        'per_page' => 100,
        'max_per_page' => 500,
    ],

    /*
    |--------------------------------------------------------------------------
    | Date Format
    |--------------------------------------------------------------------------
    |
    | Define the date format for API responses.
    |
    */
    'date_format' => 'Y-m-d H:i:s',

    /*
    |--------------------------------------------------------------------------
    | Timezone
    |--------------------------------------------------------------------------
    |
    | Define the default timezone for the calendar.
    | If null, it will use the application's timezone.
    |
    */
    'timezone' => null,
];
