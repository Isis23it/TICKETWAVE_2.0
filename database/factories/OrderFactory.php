<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id'      => User::factory(),
            'status'       => fake()->randomElement(['pending', 'confirmed', 'cancelled']),
            'total_amount' => fake()->randomFloat(2, 100, 10000),
        ];
    }
}