<?php

namespace App\Filament\Resources\TicketTypes\Pages;

use App\Filament\Resources\TicketTypes\TicketTypeResource;
use App\Filament\Resources\TicketTypes\Widgets\TicketTypeStatsWidget;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTicketTypes extends ListRecords
{
  protected static string $resource = TicketTypeResource::class;

  protected function getHeaderActions(): array
  {
    return [
      CreateAction::make(),
    ];
  }
  protected function getHeaderWidgets(): array
  {
    return [
      TicketTypeStatsWidget::class,
    ];
  }
}
