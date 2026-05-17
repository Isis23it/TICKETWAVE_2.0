<?php

namespace App\Filament\Resources\Venues\Widgets;

use App\Models\Venue;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

/**
 * Widget de estadísticas para el listado de Recintos.
 * Muestra el total, activos e inactivos.
 */
class VenueStatsWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $total    = Venue::count();
        $activos  = Venue::where('active', true)->count();
        $inactivos = Venue::where('active', false)->count();

        return [
            Stat::make('TOTAL', $total),
            Stat::make('ACTIVOS', $activos)->color('success'),
            Stat::make('INACTIVOS', $inactivos)->color('danger'),
        ];
    }
}