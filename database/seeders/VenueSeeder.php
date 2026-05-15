<?php

namespace Database\Seeders;

use App\Models\Venue;
use Illuminate\Database\Seeder;

class VenueSeeder extends Seeder
{
    public function run(): void
    {
        $venues = [
            [
                'name'         => 'Auditorio Nacional',
                'city'         => 'Ciudad de México',
                'state'        => 'CDMX',
                'neighborhood' => 'Polanco',
                'country'      => 'México',
                'postal_code'  => '11560',
                'address'      => 'Paseo de la Reforma 50',
                'capacity'     => 10000,
                'latitude'     => 19.4326,
                'longitude'    => -99.2034,
                'active'       => true,
            ],
            [
                'name'         => 'Estadio Azteca',
                'city'         => 'Ciudad de México',
                'state'        => 'CDMX',
                'neighborhood' => 'Santa Úrsula',
                'country'      => 'México',
                'postal_code'  => '14080',
                'address'      => 'Calzada de Tlalpan 3465',
                'capacity'     => 87000,
                'latitude'     => 19.3029,
                'longitude'    => -99.1505,
                'active'       => true,
            ],
            [
                'name'         => 'Teatro Metropolitán',
                'city'         => 'Ciudad de México',
                'state'        => 'CDMX',
                'neighborhood' => 'Centro Histórico',
                'country'      => 'México',
                'postal_code'  => '06600',
                'address'      => 'Independencia 90',
                'capacity'     => 2000,
                'latitude'     => 19.4284,
                'longitude'    => -99.1426,
                'active'       => true,
            ],
        ];

        foreach ($venues as $venue) {
            Venue::create($venue);
        }
    }
}