<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'order_id'       => Order::factory(),
            'payment_method' => fake()->randomElement(['tarjeta', 'paypal', 'transferencia']),
            'status'         => fake()->randomElement(['pending', 'completed', 'failed', 'refunded']),
            'transaction_id' => fake()->uuid(),
            'paid_at'        => fake()->dateTimeThisYear(),
        ];
    }
}