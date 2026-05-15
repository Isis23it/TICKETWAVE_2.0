<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\TicketType;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $compradores   = User::where('role', 'comprador')->get();
        $ticketTypes   = TicketType::all();
        $statuses      = ['pending', 'confirmed', 'cancelled'];

        for ($i = 0; $i < 10; $i++) {
            $comprador   = $compradores[$i % $compradores->count()];
            $ticketType  = $ticketTypes[$i % $ticketTypes->count()];
            $cantidad    = rand(1, 3);
            $total       = $ticketType->price * $cantidad;

            $order = Order::create([
                'user_id'      => $comprador->id,
                'status'       => $statuses[$i % 3],
                'total_amount' => $total,
            ]);

            OrderItem::create([
                'order_id'       => $order->id,
                'ticket_type_id' => $ticketType->id,
                'quantity'       => $cantidad,
                'unit_price'     => $ticketType->price,
            ]);
        }
    }
}