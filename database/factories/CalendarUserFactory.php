<?php

namespace OpenHands\BigCalendar\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use OpenHands\BigCalendar\Models\CalendarUser;

class CalendarUserFactory extends Factory
{
    protected $model = CalendarUser::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'picture_path' => null,
            'is_active' => true,
        ];
    }

    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }
}
