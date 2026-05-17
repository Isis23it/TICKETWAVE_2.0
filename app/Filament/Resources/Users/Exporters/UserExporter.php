<?php

namespace App\Filament\Resources\Users\Exporters;

use App\Models\User;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class UserExporter extends Exporter
{
  protected static ?string $model = User::class;

  public static function getColumns(): array
  {
    return [
      ExportColumn::make('name')
        ->label('Nombre'),

      ExportColumn::make('email')
        ->label('Correo electrónico'),

      ExportColumn::make('role')
        ->label('Rol'),

      ExportColumn::make('created_at')
        ->label('Fecha de registro'),
    ];
  }

  public static function getCompletedNotificationBody(Export $export): string
  {
    $count = number_format($export->successful_rows);
    return "Se exportaron {$count} usuarios correctamente.";
  }
}
