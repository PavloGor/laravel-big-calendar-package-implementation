<?php

namespace OpenHands\BigCalendar\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use OpenHands\BigCalendar\Models\CalendarEvent;
use OpenHands\BigCalendar\Models\CalendarUser;

class CalendarEventFactory extends Factory
{
    protected $model = CalendarEvent::class;

    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('now', '+1 month');
        $endDate = (clone $startDate)->modify('+' . $this->faker->numberBetween(1, 4) . ' hours');

        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->optional()->paragraph(),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'color' => $this->faker->randomElement(['blue', 'green', 'red', 'yellow', 'purple', 'orange', 'gray']),
            'user_id' => CalendarUser::factory(),
            'all_day' => $this->faker->boolean(20), // 20% chance of all-day events
        ];
    }

    public function allDay(): static
    {
        return $this->state(function (array $attributes) {
            $startDate = $this->faker->dateTimeBetween('now', '+1 month');
            $startDate->setTime(0, 0, 0);
            $endDate = (clone $startDate)->setTime(23, 59, 59);

            return [
                'start_date' => $startDate,
                'end_date' => $endDate,
                'all_day' => true,
            ];
        });
    }

    public function multiDay(): static
    {
        return $this->state(function (array $attributes) {
            $startDate = $this->faker->dateTimeBetween('now', '+1 month');
            $endDate = (clone $startDate)->modify('+' . $this->faker->numberBetween(1, 5) . ' days');

            return [
                'start_date' => $startDate,
                'end_date' => $endDate,
            ];
        });
    }

    public function withColor(string $color): static
    {
        return $this->state(fn (array $attributes) => [
            'color' => $color,
        ]);
    }
}