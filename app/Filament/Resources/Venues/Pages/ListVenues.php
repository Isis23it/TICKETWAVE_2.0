<?php

namespace App\Filament\Resources\Venues\Pages;

use App\Filament\Resources\Venues\VenueResource;
use App\Filament\Resources\Venues\Widgets\VenueStatsWidget;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListVenues extends ListRecords
{
    protected static string $resource = VenueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('Nuevo Recinto'),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            VenueStatsWidget::class,
        ];
    }
}