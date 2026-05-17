<?php

namespace App\Filament\Resources\Venues;

use App\Filament\Resources\Venues\Pages\CreateVenue;
use App\Filament\Resources\Venues\Pages\EditVenue;
use App\Filament\Resources\Venues\Pages\ListVenues;
use App\Filament\Resources\Venues\Schemas\VenueForm;
use App\Filament\Resources\Venues\Tables\VenuesTable;
use App\Filament\Resources\Venues\Widgets\VenueStatsWidget;
use App\Models\Venue;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

/**
 * Resource de Filament para gestionar Recintos.
 *
 * Permite al administrador crear, ver, editar y eliminar recintos
 * desde el panel de administración.
 */
class VenueResource extends Resource
{
    protected static ?string $model = Venue::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMapPin;

    protected static ?string $recordTitleAttribute = 'name';

    /** Etiqueta del recurso en español */
    protected static ?string $navigationLabel = 'Recintos';

    protected static ?string $modelLabel = 'Recinto';

    protected static ?string $pluralModelLabel = 'Recintos';

    protected static ?int $navigationSort = 2;

    public static function getNavigationGroup(): ?string
    {
        return 'Principal';
    }

    public static function getWidgets(): array
    {
        return [
            VenueStatsWidget::class,
        ];
    }

    public static function form(Schema $schema): Schema
    {
        return VenueForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return VenuesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListVenues::route('/'),
            'create' => CreateVenue::route('/create'),
            'edit' => EditVenue::route('/{record}/edit'),
        ];
    }
}