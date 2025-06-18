# Laravel Big Calendar

[![Latest Version on Packagist](https://img.shields.io/packagist/v/openhands/laravel-big-calendar.svg?style=flat-square)](https://packagist.org/packages/openhands/laravel-big-calendar)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/openhands/laravel-big-calendar/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/openhands/laravel-big-calendar/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/openhands/laravel-big-calendar/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/openhands/laravel-big-calendar/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/openhands/laravel-big-calendar.svg?style=flat-square)](https://packagist.org/packages/openhands/laravel-big-calendar)

A comprehensive Laravel package for building powerful calendar applications with multiple views, drag & drop functionality, and real-time features.

## Features

📅 **Multiple calendar views:**
- Agenda view
- Year view  
- Month view
- Week view with detailed time slots
- Day view with hourly breakdown

🎨 **Event customization:**
- Multiple color options for events
- Three badge display variants (dot, colored and mixed)
- Support for single and multi-day events

🔄 **Drag and Drop:**
- Easily reschedule events by dragging and dropping
- Move events between days in month view
- Adjust event timing in week/day views
- Visual feedback during dragging operations

👥 **User management:**
- Filter events by user
- View all users's events simultaneously
- User avatars and profile integration

⚡ **Real-time features:**
- Live time indicator
- Current event highlighting
- Dynamic event positioning

⏰ **Time customization:**
- Configurable working hours with distinct styling
- Adjustable visible hours range
- Focus on relevant time periods

🎯 **UI/UX features:**
- Responsive design for all screen sizes
- Intuitive navigation between dates
- Clean and modern interface
- Dark mode support

## Installation

You can install the package via composer:

```bash
composer require openhands/laravel-big-calendar
```

Install the package using the artisan command:

```bash
php artisan big-calendar:install
```

This will:
- Publish and run the migrations
- Publish the configuration file
- Set up the API routes

To install with sample data:

```bash
php artisan big-calendar:install --seed
```

## Configuration

The configuration file will be published to `config/big-calendar.php`. You can customize:

- Default calendar view
- Available event colors
- Working hours
- Time slot duration
- API middleware
- And much more...

## API Endpoints

The package provides RESTful API endpoints:

### Events
- `GET /api/big-calendar/events` - List events with filtering
- `POST /api/big-calendar/events` - Create new event
- `GET /api/big-calendar/events/{id}` - Get specific event
- `PUT /api/big-calendar/events/{id}` - Update event
- `DELETE /api/big-calendar/events/{id}` - Delete event
- `POST /api/big-calendar/events/{id}/move` - Move event (drag & drop)
- `POST /api/big-calendar/events/{id}/resize` - Resize event

### Users
- `GET /api/big-calendar/users` - List active users
- `GET /api/big-calendar/users/{id}` - Get specific user

## Usage

### Creating Events

```php
use OpenHands\BigCalendar\Models\CalendarEvent;

$event = CalendarEvent::create([
    'title' => 'Team Meeting',
    'description' => 'Weekly team sync',
    'start_date' => '2024-01-15 10:00:00',
    'end_date' => '2024-01-15 11:00:00',
    'color' => 'blue',
    'user_id' => 1,
    'all_day' => false,
]);
```

### Filtering Events

```php
// Get events for a date range
$events = CalendarEvent::inDateRange(
    Carbon::parse('2024-01-01'),
    Carbon::parse('2024-01-31')
)->get();

// Get events for specific users
$events = CalendarEvent::whereIn('user_id', [1, 2, 3])->get();

// Get events by color
$events = CalendarEvent::withColor('blue')->get();
```

### Using the Facade

```php
use OpenHands\BigCalendar\Facades\BigCalendar;

// Get events for current month
$events = BigCalendar::getEventsForMonth();

// Get events for specific date range
$events = BigCalendar::getEventsForDateRange(
    Carbon::parse('2024-01-01'),
    Carbon::parse('2024-01-31')
);

// Create event
$event = BigCalendar::createEvent([
    'title' => 'New Event',
    'start_date' => '2024-01-15 10:00:00',
    'end_date' => '2024-01-15 11:00:00',
    'color' => 'green',
    'user_id' => 1,
]);
```

## Frontend Integration

This package provides the backend API. For the frontend calendar component, you can use the [Big Calendar React component](https://github.com/PavloGor/big-calendar) or integrate with any calendar library that supports REST APIs.

### Example API Usage

```javascript
// Fetch events
const response = await fetch('/api/big-calendar/events?start_date=2024-01-01&end_date=2024-01-31');
const { data: events } = await response.json();

// Create event
const newEvent = await fetch('/api/big-calendar/events', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({
        title: 'New Meeting',
        start_date: '2024-01-15T10:00:00Z',
        end_date: '2024-01-15T11:00:00Z',
        color: 'blue',
        user_id: 1
    })
});

// Move event (drag & drop)
await fetch(`/api/big-calendar/events/${eventId}/move`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({
        start_date: '2024-01-16T10:00:00Z',
        end_date: '2024-01-16T11:00:00Z'
    })
});
```

## Models

### CalendarEvent

The main event model with the following attributes:
- `title` - Event title
- `description` - Event description (optional)
- `start_date` - Event start date/time
- `end_date` - Event end date/time
- `color` - Event color (blue, green, red, yellow, purple, orange, gray)
- `user_id` - Associated user ID
- `all_day` - Boolean for all-day events

### CalendarUser

User model for calendar users:
- `name` - User name
- `email` - User email
- `picture_path` - Path to user avatar (optional)
- `is_active` - Boolean for active users

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [OpenHands](https://github.com/openhands)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.