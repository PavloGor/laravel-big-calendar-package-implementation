# Laravel Big Calendar Package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/openhands/laravel-big-calendar.svg?style=flat-square)](https://packagist.org/packages/openhands/laravel-big-calendar)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/PavloGor/laravel-big-calendar-package-implementation/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/PavloGor/laravel-big-calendar-package-implementation/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/PavloGor/laravel-big-calendar-package-implementation/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/PavloGor/laravel-big-calendar-package-implementation/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/openhands/laravel-big-calendar.svg?style=flat-square)](https://packagist.org/packages/openhands/laravel-big-calendar)

A comprehensive Laravel 12 package that provides complete backend API functionality for calendar applications. Designed to work seamlessly with the [Big Calendar frontend](https://github.com/PavloGor/big-calendar).

## 🚀 Features

### 📅 Calendar Management
- **Event CRUD Operations**: Complete event management with validation
- **User Management**: User system with automatic avatar generation
- **Drag & Drop Support**: API endpoints for moving and resizing events
- **Multi-day Events**: Support for single and multi-day events
- **Event Filtering**: Filter by date ranges, users, and custom criteria

### 🎨 Customization
- **Event Colors**: Multiple color options for events
- **Badge Variants**: Support for dot, colored, and mixed badge displays
- **Working Hours**: Configurable business hours with distinct styling
- **Time Zones**: Full timezone support with Carbon integration

### 🌐 API Features
- **RESTful API**: Clean, consistent API endpoints
- **JSON Resources**: Structured API responses
- **Validation**: Comprehensive request validation
- **Error Handling**: Proper error responses and status codes

### 🔧 Developer Experience
- **Easy Installation**: One-command installation via Artisan
- **Sample Data**: Optional seeding with realistic sample data
- **Comprehensive Tests**: Full test suite with Pest framework
- **Documentation**: Complete API documentation and examples

## 📦 Installation

You can install the package via composer:

```bash
composer require openhands/laravel-big-calendar
```

Run the installation command:

```bash
php artisan big-calendar:install
```

Optionally, seed with sample data:

```bash
php artisan big-calendar:install --seed
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="big-calendar-config"
```

## 🌐 API Endpoints

### Events Management

| Method | Endpoint | Description |
|--------|----------|-------------|
| `GET` | `/api/big-calendar/events` | List all events with filtering |
| `POST` | `/api/big-calendar/events` | Create a new event |
| `GET` | `/api/big-calendar/events/{id}` | Get specific event |
| `PUT` | `/api/big-calendar/events/{id}` | Update event |
| `DELETE` | `/api/big-calendar/events/{id}` | Delete event |
| `POST` | `/api/big-calendar/events/{id}/move` | Move event (drag & drop) |
| `POST` | `/api/big-calendar/events/{id}/resize` | Resize event |

### Users Management

| Method | Endpoint | Description |
|--------|----------|-------------|
| `GET` | `/api/big-calendar/users` | List all users |
| `GET` | `/api/big-calendar/users/{id}` | Get specific user |

## 📊 API Examples

### Create Event

```bash
curl -X POST /api/big-calendar/events \
  -H "Content-Type: application/json" \
  -d '{
    "title": "Team Meeting",
    "description": "Weekly team sync",
    "start_date": "2025-06-20 10:00:00",
    "end_date": "2025-06-20 11:00:00",
    "color": "blue",
    "all_day": false,
    "user_id": 1
  }'
```

### Response Format

```json
{
  "success": true,
  "data": {
    "id": 1,
    "title": "Team Meeting",
    "description": "Weekly team sync",
    "startDate": "2025-06-20T10:00:00.000000Z",
    "endDate": "2025-06-20T11:00:00.000000Z",
    "color": "blue",
    "allDay": false,
    "isMultiDay": false,
    "durationMinutes": 60,
    "user": {
      "id": 1,
      "name": "John Doe",
      "email": "john@example.com",
      "avatarUrl": "https://ui-avatars.com/api/?name=JD&background=random",
      "isActive": true
    }
  },
  "message": "Event created successfully"
}
```

### Filter Events

```bash
# Filter by date range
GET /api/big-calendar/events?start_date=2025-06-01&end_date=2025-06-30

# Filter by user
GET /api/big-calendar/events?user_id=1

# Combined filters
GET /api/big-calendar/events?start_date=2025-06-01&end_date=2025-06-30&user_id=1
```

### Move Event (Drag & Drop)

```bash
curl -X POST /api/big-calendar/events/1/move \
  -H "Content-Type: application/json" \
  -d '{
    "start_date": "2025-06-21 10:00:00",
    "end_date": "2025-06-21 11:00:00"
  }'
```

## ⚙️ Configuration

The package configuration file `config/big-calendar.php` provides extensive customization options:

```php
return [
    // Database table names
    'tables' => [
        'users' => 'calendar_users',
        'events' => 'calendar_events',
    ],

    // API configuration
    'api' => [
        'prefix' => 'big-calendar',
        'middleware' => ['api'],
    ],

    // Event colors
    'colors' => [
        'blue', 'green', 'red', 'yellow', 'purple', 'pink', 'orange', 'gray'
    ],

    // Calendar views
    'views' => [
        'agenda' => true,
        'year' => true,
        'month' => true,
        'week' => true,
        'day' => true,
    ],

    // Working hours
    'working_hours' => [
        'start' => '09:00',
        'end' => '17:00',
        'days' => [1, 2, 3, 4, 5], // Monday to Friday
    ],

    // Default settings
    'defaults' => [
        'event_duration' => 60, // minutes
        'color' => 'blue',
        'all_day' => false,
    ],
];
```

## 🧪 Testing

Run the tests with:

```bash
./vendor/bin/pest
```

The package includes comprehensive tests covering:
- Event CRUD operations
- User management
- API endpoints
- Model relationships
- Validation rules

## 📖 Frontend Integration

This package is designed to work with the [Big Calendar frontend]([https://github.com/PavloGor/big-calendar](https://github.com/lramos33/big-calendar). Update your frontend API configuration to point to these endpoints:

```javascript
// Example frontend configuration
const API_BASE_URL = 'http://your-laravel-app.com/api/big-calendar';

// Fetch events
const events = await fetch(`${API_BASE_URL}/events?start_date=2025-06-01&end_date=2025-06-30`);

// Create event
const newEvent = await fetch(`${API_BASE_URL}/events`, {
  method: 'POST',
  headers: { 'Content-Type': 'application/json' },
  body: JSON.stringify({
    title: 'New Event',
    start_date: '2025-06-20 10:00:00',
    end_date: '2025-06-20 11:00:00',
    user_id: 1
  })
});
```

## 🔄 Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## 🤝 Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## 🔒 Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## 📄 Credits

- [OpenHands AI](https://github.com/openhands)
- [Spatie Package Skeleton](https://github.com/spatie/package-skeleton-laravel)
- [All Contributors](../../contributors)

## 📜 License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

---

## 🚀 Quick Start Example

Here's a complete example of setting up and using the package:

```bash
# 1. Install the package
composer require openhands/laravel-big-calendar

# 2. Install and seed
php artisan big-calendar:install --seed

# 3. Test the API
curl http://your-app.com/api/big-calendar/events
```

That's it! You now have a fully functional calendar API ready to integrate with your frontend.

## 📞 Support

- **Documentation**: See the `PACKAGE_SUMMARY.md` file for detailed documentation
- **Issues**: [GitHub Issues](https://github.com/PavloGor/laravel-big-calendar-package-implementation/issues)
- **Frontend**: [Big Calendar]([https://github.com/PavloGor/big-calendar](https://github.com/lramos33/big-calendar)

---

**Package**: `openhands/laravel-big-calendar`  
**Laravel**: ^12.0  
**PHP**: ^8.1+  
**Frontend**: [Big Calendar](https://github.com/PavloGor/big-calendar)
