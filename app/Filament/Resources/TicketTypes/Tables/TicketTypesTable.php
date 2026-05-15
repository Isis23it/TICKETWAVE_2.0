<?php

namespace App\Filament\Resources\TicketTypes\Tables;


use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\Filter;
use Filament\Actions\ViewAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Actions\DeleteAction;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;

/**
 * Configuración de la tabla para listar Ticket Types.
 *
 * Muestra precio, cantidades, stock restante con badge y estado de venta.
 * Usa recordActions() y toolbarActions() — API de Filament v3.2+.
 */
class TicketTypesTable
{
  public static function configure(Table $table): Table
  {
    return $table
      ->columns([
        TextColumn::make('event.name')
          ->label('Event')
          ->sortable()
          ->searchable()
          ->weight('font-bold')
          ->icon('heroicon-o-calendar'),

        TextColumn::make('name')
          ->label('Ticket Type')
          ->searchable()
          ->sortable(),

        TextColumn::make('price')
          ->label('Price')
          ->money('USD')
          ->sortable()
          ->alignment('right')
          ->color('success'),

        TextColumn::make('quantity_available')
          ->label('Available')
          ->sortable()
          ->alignment('center'),

        TextColumn::make('quantity_sold')
          ->label('Sold')
          ->sortable()
          ->alignment('center')
          ->color('warning'),

        TextColumn::make('stock_remaining')
          ->label('Stock Left')
          ->sortable()
          ->alignment('center')
          ->badge()
          ->color(fn(int $state): string => match (true) {
            $state > 10 => 'success',
            $state > 0 => 'warning',
            default => 'danger',
          }),

        IconColumn::make('has_stock')
          ->label('On Sale')
          ->boolean()
          ->alignment('center'),

        TextColumn::make('created_at')
          ->label('Created')
          ->dateTime('d/m/Y H:i')
          ->sortable()
          ->toggleable(isToggledHiddenByDefault: true),
      ])
      ->defaultSort('created_at', 'desc')
      ->filters([
        SelectFilter::make('event')
          ->relationship('event', 'name')
          ->searchable()
          ->preload()
          ->label('Filter by Event'),

        Filter::make('in_stock')
          ->label('Only in stock')
          ->query(fn(Builder $query): Builder => $query->whereColumn('quantity_available', '>', 'quantity_sold')),
      ])
      ->recordActions([
        ViewAction::make(),
        EditAction::make(),
        DeleteAction::make(),
      ])
      ->toolbarActions([
        BulkActionGroup::make([
          DeleteBulkAction::make(),
        ]),
      ])
      ->emptyStateHeading('No ticket types registered')
      ->emptyStateDescription('Create the first ticket type for an event.')
      ->emptyStateIcon('heroicon-o-ticket');
  }
}
