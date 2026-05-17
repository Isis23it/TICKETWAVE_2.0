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
    $disponibles = TicketType::whereColumn('quantity_sold', '<', 'quantity_available')->count();
    $agotados    = TicketType::whereColumn('quantity_sold', '>=', 'quantity_available')->count();

    return [
      Stat::make('TOTAL', $total),
      Stat::make('DISPONIBLES', $disponibles)->color('success'),
      Stat::make('AGOTADOS', $agotados)->color('danger'),
    ];
  }
}
