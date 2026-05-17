<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class OrderInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('user.name')
                    ->label('Usuario'),
                TextEntry::make('status')
                    ->label('Estado')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending'   => 'warning',
                        'confirmed' => 'success',
                        'cancelled' => 'danger',
                        default     => 'gray',
                    }),
                TextEntry::make('total_amount')
                    ->label('Monto Total')
                    ->money('MXN'),
                TextEntry::make('payment.payment_method')
                    ->label('Método de Pago')
                    ->default('-'),
                TextEntry::make('payment.status')
                    ->label('Estado del Pago')
                    ->badge()
                    ->default('-'),
                TextEntry::make('created_at')
                    ->label('Fecha de la Orden')
                    ->dateTime('d/m/Y H:i'),
                // items de la orden
                RepeatableEntry::make('items')
                    ->label('Items de la Orden')
                    ->schema([
                        TextEntry::make('ticketType.name')
                            ->label('Tipo de Entrada'),
                        TextEntry::make('quantity')
                            ->label('Cantidad'),
                        TextEntry::make('unit_price')
                            ->label('Precio Unitario')
                            ->money('MXN'),
                    ]),
            ]);
    }
}