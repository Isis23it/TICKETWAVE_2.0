<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // solo se permite cambiar el estado
                // las órdenes no se crean manualmente
                Select::make('status')
                    ->label('Estado')
                    ->options([
                        'pending'   => 'Pendiente',
                        'confirmed' => 'Confirmado',
                        'cancelled' => 'Cancelado',
                    ])
                    ->required(),
            ]);
    }
}