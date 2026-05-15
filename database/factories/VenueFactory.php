<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VenueFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'         => fake()->company() . ' Arena',
            'city'         => fake()->city(),
            'state'        => fake()->state(),
            'neighborhood' => fake()->streetName(),
            'country'      => 'México',
            'postal_code'  => fake()->numerify('#####'),
            'address'      => fake()->streetAddress(),
            'capacity'     => fake()->numberBetween(500, 90000),
            'latitude'     => fake()->latitude(14, 32),
            'longitude'    => fake()->longitude(-118, -86),
            'image_url'    => null,
            'active'       => true,
        ];
    }
}