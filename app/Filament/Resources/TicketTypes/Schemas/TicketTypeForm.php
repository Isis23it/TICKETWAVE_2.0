<?php

namespace App\Filament\Resources\TicketTypes\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use App\Models\Event;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;

/**
 * Schema del formulario para crear/editar Ticket Types.
 *
 * Valida que quantity_available no supere la capacidad del venue del evento.
 */
class TicketTypeForm
{
  public static function configure(Schema $schema): Schema
  {
    return $schema
      ->components([
        // ── Sección 1: Información básica ──────────────────────
        Section::make('Información básica')
          ->columns(2)
          ->schema([

            TextInput::make('name')
              ->label('Nombre')
              ->placeholder('Ej. General, VIP, Platino')
              ->required()
              ->maxLength(100)
              ->unique(ignoreRecord: true)
              ->helperText('Máximo 100 caracteres · visible para el comprador'),

            Select::make('event_id')
              ->label('Evento')
              ->relationship('event', 'name')
              ->searchable()
              ->preload()
              ->required()
              ->placeholder('Selecciona un evento')
              ->helperText('El tipo de entrada quedará vinculado a este evento')
              ->live(),

            Textarea::make('description')
              ->label('Descripción')
              ->placeholder('Detalles de lo que incluye este tipo de entrada...')
              ->maxLength(500)
              ->helperText('Opcional · Se muestra en la página pública del evento')
              ->columnSpanFull(),
          ]),

        // ── Sección 2: Precio y disponibilidad ─────────────────
        Section::make('Precio y disponibilidad')
          ->columns(3)
          ->schema([

            TextInput::make('price')
              ->label('Precio unitario')
              ->required()
              ->numeric()
              ->prefix('$')
              ->maxValue(999999.99)
              ->minValue(0.01)
              ->step(0.01)
              ->helperText('En MXN · sin comisión de servicio')
              ->validationMessages([
                'min' => 'El precio debe ser mayor a $0.00',
              ]),

            TextInput::make('quantity_available')
              ->label('Cantidad disponible')
              ->required()
              ->numeric()
              ->integer()
              ->minValue(1)
              ->helperText('No puede superar la capacidad del recinto')
              ->validationMessages([
                'min' => 'La cantidad mínima es 1.',
              ])
              ->rules([
                function (Get $get) {
                  return function ($attribute, $value, $fail) use ($get) {
                    $eventId = $get('event_id');
                    if (!$eventId) return;

                    $event = Event::with('venue')->find($eventId);
                    if (!$event || !$event->venue) return;

                    $capacity = $event->venue->capacity ?? PHP_INT_MAX;
                    if ($value > $capacity) {
                      $fail("La cantidad ({$value}) no puede superar la capacidad del recinto ({$capacity}).");
                    }
                  };
                },
              ]),

            TextInput::make('max_per_order')
              ->label('Límite por compra')
              ->numeric()
              ->integer()
              ->minValue(1)
              ->maxValue(50)
              ->nullable()
              ->placeholder('Sin límite')
              ->helperText('Boletos máximos por orden'),
          ]),
      ]);
  }
}
