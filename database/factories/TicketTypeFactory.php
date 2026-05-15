<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketTypeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'event_id'           => Event::factory(),
            'name'               => fake()->randomElement(['General', 'VIP', 'Platea', 'Balcón']),
            'description'        => fake()->sentence(),
            'quantity_available' => fake()->numberBetween(50, 1000),
            'quantity_sold'      => 0,
            'price'              => fake()->randomFloat(2, 100, 5000),
            'max_per_order'      => fake()->randomElement([2, 4, 6, null]),
        ];
    }
}