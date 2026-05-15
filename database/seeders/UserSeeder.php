<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1 admin
        User::create([
            'role'     => 'admin',
            'name'     => 'Administrador',
            'email'    => 'admin@ticketwave.com',
            'password' => Hash::make('password'),
        ]);

        // 5 compradores
        $compradores = [
            ['name' => 'Juan Pérez',      'email' => 'juan@example.com'],
            ['name' => 'María García',    'email' => 'maria@example.com'],
            ['name' => 'Carlos López',    'email' => 'carlos@example.com'],
            ['name' => 'Ana Martínez',    'email' => 'ana@example.com'],
            ['name' => 'Luis Rodríguez',  'email' => 'luis@example.com'],
        ];

        foreach ($compradores as $comprador) {
            User::create([
                'role'     => 'comprador',
                'name'     => $comprador['name'],
                'email'    => $comprador['email'],
                'password' => Hash::make('password'),
            ]);
        }
    }
}