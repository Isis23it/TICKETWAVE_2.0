<?php

namespace App\Filament\Resources\TicketTypes\Widgets;

use App\Models\TicketType;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TicketTypeStatsWidget extends StatsOverviewWidget
{
  protected function getStats(): array
  {
    $total       = TicketType::count();
    $disponibles = TicketType::where('quantity_available', '>', 0)->count();
    $agotados    = TicketType::where('quantity_available', 0)->count();

    return [
      Stat::make('TOTAL', $total),

      Stat::make('DISPONIBLES', $disponibles)
        ->color('success'),

      Stat::make('AGOTADOS', $agotados)
        ->color('danger'),
    ];
  }
}
