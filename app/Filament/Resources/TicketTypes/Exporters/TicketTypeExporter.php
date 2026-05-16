<?php

namespace App\Filament\Resources\TicketTypes\Exporters;

use App\Models\TicketType;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class TicketTypeExporter extends Exporter
{
  protected static ?string $model = TicketType::class;

  public static function getColumns(): array
  {
    return [
      ExportColumn::make('name')
        ->label('Nombre'),

      ExportColumn::make('event.name')
        ->label('Evento'),

      ExportColumn::make('price')
        ->label('Precio'),

      ExportColumn::make('quantity_available')
        ->label('Disponibles'),

      ExportColumn::make('quantity_sold')
        ->label('Vendidos'),

      ExportColumn::make('max_per_order')
        ->label('Límite por orden'),

      ExportColumn::make('created_at')
        ->label('Creado'),
    ];
  }

  public static function getCompletedNotificationBody(Export $export): string
  {
    $count = number_format($export->successful_rows);
    return "Se exportaron {$count} tipos de entrada correctamente.";
  }
}
