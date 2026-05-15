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
        Section::make('Ticket Information')
          ->description('Define the ticket type, price and availability')
          ->icon('heroicon-o-ticket')
          ->columns(2)
          ->schema([
            Select::make('event_id')
              ->label('Event')
              ->relationship('event', 'name')
              ->searchable()
              ->preload()
              ->required()
              ->placeholder('Select an event')
              ->helperText('The ticket type will be linked to this event.')
              ->live(),

            TextInput::make('name')
              ->label('Ticket Type Name')
              ->placeholder('e.g. General, VIP, Platinum')
              ->required()
              ->maxLength(100)
              ->unique(ignoreRecord: true)
              ->helperText('Examples: General, VIP, Early Bird, Backstage'),

            Textarea::make('description')
              ->label('Description')
              ->placeholder('Details of what this ticket includes...')
              ->maxLength(500)
              ->columnSpanFull(),

            TextInput::make('price')
              ->label('Price')
              ->required()
              ->numeric()
              ->prefix('$')
              ->maxValue(999999.99)
              ->minValue(0.01)
              ->step(0.01)
              ->validationMessages([
                'min' => 'Price must be greater than $0.00',
              ]),

            TextInput::make('quantity_available')
              ->label('Quantity Available')
              ->required()
              ->numeric()
              ->integer()
              ->minValue(1)
              ->helperText('Number of tickets of this type to be sold.')
              ->validationMessages([
                'min' => 'Quantity available must be at least 1.',
              ])
              // Validación custom: disponibles ≤ capacidad del venue
              ->rules([
                function (Get $get) {
                  return function ($attribute, $value, $fail) use ($get) {
                    $eventId = $get('event_id');
                    if (!$eventId) return;

                    $event = Event::with('venue')->find($eventId);
                    if (!$event || !$event->venue) return;

                    $capacity = $event->venue->capacity ?? PHP_INT_MAX;
                    if ($value > $capacity) {
                      $fail("Quantity available ({$value}) cannot exceed venue capacity ({$capacity}).");
                    }
                  };
                },
              ]),

            TextInput::make('max_per_order')
              ->label('Max Per Order')
              ->numeric()
              ->integer()
              ->minValue(1)
              ->maxValue(50)
              ->nullable()
              ->placeholder('No limit')
              ->helperText('Maximum tickets of this type a user can buy in one order. Leave empty for no limit.'),
          ]),

        Section::make('Capacity Validation')
          ->description('Quantity available cannot exceed the venue capacity of the event.')
          ->icon('heroicon-o-exclamation-triangle')
          ->schema([])
          ->visible(fn(Get $get) => filled($get('event_id'))),
      ]);
  }
}
