<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
use App\Models\Venue;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $admin  = User::where('role', 'admin')->first();
        $venues = Venue::all();

        $events = [
            [
                'name'        => 'Festival de Rock 2026',
                'description' => 'El mejor festival de rock del año.',
                'category'    => 'concert',
                'status'      => 'published',
                'event_date'  => '2026-07-15 20:00:00',
                'venue_id'    => $venues[0]->id,
            ],
            [
                'name'        => 'Final de Liga MX',
                'description' => 'La gran final del torneo.',
                'category'    => 'sport',
                'status'      => 'published',
                'event_date'  => '2026-06-01 18:00:00',
                'venue_id'    => $venues[1]->id,
            ],
            [
                'name'        => 'El Fantasma de la Ópera',
                'description' => 'El clásico musical en su versión más esp...',
                'category'    => 'theater',
                'status'      => 'published',
                'event_date'  => '2026-06-20 19:00:00',
                'venue_id'    => $venues[2]->id,
            ],
            [
                'name'        => 'Concierto de Jazz',
                'description' => 'Una noche de jazz en vivo.',
                'category'    => 'concert',
                'status'      => 'draft',
                'event_date'  => '2026-09-10 21:00:00',
                'venue_id'    => $venues[0]->id,
            ],
            [
                'name'        => 'Torneo de Tenis',
                'description' => 'Torneo internacional de tenis.',
                'category'    => 'sport',
                'status'      => 'cancelled',
                'event_date'  => '2026-05-01 10:00:00',
                'venue_id'    => $venues[1]->id,
            ],
        ];

        foreach ($events as $event) {
            Event::create([
                'user_id' => $admin->id,
                ...$event,
            ]);
        }
    }
}