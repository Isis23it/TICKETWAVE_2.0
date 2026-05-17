<?php

namespace App\Filament\Resources\Users\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UserStatsWidget extends StatsOverviewWidget
{
  protected function getStats(): array
  {
    return [
      Stat::make('TOTAL', User::count()),

      Stat::make('COMPRADORES', User::where('role', 'comprador')->count())
        ->color('success'),

      Stat::make('ORGANIZADORES', User::where('role', 'organizer')->count())
        ->color('warning'),

      Stat::make('ADMINISTRADORES', User::where('role', 'admin')->count())
        ->color('danger'),
    ];
  }
}
