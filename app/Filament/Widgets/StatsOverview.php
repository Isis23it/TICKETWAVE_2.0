<?php

namespace App\Filament\Widgets;

use App\Models\Event;
use App\Models\Order;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

/**
 * Widget del dashboard de administración.
 * Muestra métricas en tiempo real calculadas desde la BD.
 */
class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            // Total de eventos registrados en la plataforma
            Stat::make('Total de eventos', Event::count())
                ->description('Eventos registrados')
                ->icon('heroicon-o-calendar'),

            // Solo pedidos con status 'confirmed' cuentan como pagados
            Stat::make('Pedidos pagados', Order::where('status', 'confirmed')->count())
                ->description('Órdenes confirmadas')
                ->icon('heroicon-o-shopping-cart'),

            // Suma de monto_total solo de pedidos confirmados
            Stat::make('Ingresos totales', '$' . number_format(
                Order::where('status', 'confirmed')->sum('total_amount'), 2
            ))
                ->description('De pedidos confirmados')
                ->icon('heroicon-o-currency-dollar'),

            // Total de usuarios registrados sin importar rol
            Stat::make('Usuarios registrados', User::count())
                ->description('Compradores y organizadores')
                ->icon('heroicon-o-users'),
        ];
    }
}