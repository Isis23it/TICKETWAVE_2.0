<?php

namespace App\Filament\Resources\TicketTypes;

use App\Filament\Resources\TicketTypes\Widgets\TicketTypeStatsWidget;
use App\Filament\Resources\TicketTypes\Pages\CreateTicketType;
use App\Filament\Resources\TicketTypes\Pages\EditTicketType;
use App\Filament\Resources\TicketTypes\Pages\ListTicketTypes;
use App\Filament\Resources\TicketTypes\Schemas\TicketTypeForm;
use App\Filament\Resources\TicketTypes\Tables\TicketTypesTable;
use App\Models\TicketType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use App\Filament\Resources\TicketTypeResource\Pages;

/**
 * Resource de Filament para gestionar Tipos de Boleto (Ticket Types).
 *
 * Permite al organizador definir los tipos de boleto de cada evento
 * con su precio y cantidad disponible.
 */
class TicketTypeResource extends Resource
{
  protected static ?string $model = TicketType::class;

  protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

  protected static ?string $recordTitleAttribute = 'name';

  protected static ?string $navigationLabel = 'Tipo de entrada';

  protected static ?string $modelLabel = 'Tipo de entrada';

  protected static ?string $pluralModelLabel = 'Ticket Types';

  public static function getNavigationGroup(): ?string
  {
    return 'Principal';
  }

  public static function getWidgets(): array
  {
    return [
      TicketTypeStatsWidget::class,
    ];
  }

  protected static ?int $navigationSort = 3;

  public static function form(Schema $schema): Schema
  {
    return TicketTypeForm::configure($schema);
  }

  public static function table(Table $table): Table
  {
    return TicketTypesTable::configure($table);
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
      'index' => ListTicketTypes::route('/'),
      'create' => CreateTicketType::route('/create'),
      'edit' => EditTicketType::route('/{record}/edit'),
    ];
  }
}
