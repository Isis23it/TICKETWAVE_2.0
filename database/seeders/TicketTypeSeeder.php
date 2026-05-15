<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\TicketType;
use Illuminate\Database\Seeder;

class TicketTypeSeeder extends Seeder
{
    public function run(): void
    {
        $events = Event::all();

        foreach ($events as $event) {
            TicketType::create([
                'event_id'           => $event->id,
                'name'               => 'General',
                'description'        => 'Acceso general al evento.',
                'quantity_available' => 500,
                'quantity_sold'      => 0,
                'price'              => 800.00,
                'max_per_order'      => 4,
            ]);

            TicketType::create([
                'event_id'           => $event->id,
                'name'               => 'VIP',
                'description'        => 'Acceso VIP con zona preferencial.',
                'quantity_available' => 100,
                'quantity_sold'      => 0,
                'price'              => 2500.00,
                'max_per_order'      => 2,
            ]);
        }
    }
}