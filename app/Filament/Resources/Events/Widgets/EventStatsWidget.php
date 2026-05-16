<?php

namespace App\Filament\Resources\Events\Widgets;

use App\Models\Event;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

/**
 * Widget de estadísticas para el listado de Eventos.
 * Muestra el total, publicados y cancelados.
 */
class EventStatsWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $total      = Event::count();
        $publicados = Event::where('status', 'published')->count();
        $agotados   = Event::where('status', 'cancelled')->count();

        return [
            Stat::make('TOTAL', $total),
            Stat::make('DISPONIBLES', $publicados)->color('success'),
            Stat::make('AGOTADOS', $agotados)->color('danger'),
        ];
    }
}