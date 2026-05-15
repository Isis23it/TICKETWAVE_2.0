<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Venue;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id'     => User::factory(),
            'venue_id'    => Venue::factory(),
            'name'        => fake()->sentence(3),
            'description' => fake()->paragraph(),
            'category'    => fake()->randomElement(['concert', 'sport', 'theater', 'other']),
            'image_url'   => null,
            'status'      => fake()->randomElement(['draft', 'published', 'cancelled']),
            'event_date'  => fake()->dateTimeBetween('+1 month', '+1 year'),
        ];
    }
}