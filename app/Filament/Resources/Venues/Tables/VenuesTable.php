<?php

namespace App\Filament\Resources\Venues\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

/**
 * Configuración de la tabla para listar Recintos.
 *
 * Muestra nombre, ciudad, estado, capacidad y estado activo.
 * Incluye acciones de editar y eliminar con confirmación.
 */
class VenuesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('city')
                    ->label('Ciudad')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('state')
                    ->label('Estado')
                    ->searchable(),

                TextColumn::make('country')
                    ->label('País')
                    ->searchable(),

                TextColumn::make('capacity')
                    ->label('Capacidad')
                    ->numeric()
                    ->sortable(),

                IconColumn::make('active')
                    ->label('Activo')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('active')
                    ->label('Estado')
                    ->options([
                        '1' => 'Activo',
                        '0' => 'Inactivo',
                    ]),
            ])
            ->recordActions([
                EditAction::make()->label('Editar'),
                DeleteAction::make()->label('Eliminar'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label('Eliminar seleccionados'),
                ]),
            ])
            ->emptyStateHeading('Sin recintos')
            ->emptyStateDescription('Crea el primer recinto.')
            ->emptyStateIcon('heroicon-o-map-pin');
    }
}