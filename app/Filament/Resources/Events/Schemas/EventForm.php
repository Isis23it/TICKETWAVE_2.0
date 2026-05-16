<?php

namespace App\Filament\Resources\Events\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

/**
 * Formulario para crear y editar Eventos.
 * Campos en español con validaciones y valores por defecto.
 */
class EventForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->label('Usuario')
                    ->relationship('user', 'name')
                    ->required(),

                Select::make('venue_id')
                    ->label('Recinto')
                    ->relationship('venue', 'name')
                    ->required(),

                TextInput::make('name')
                    ->label('Nombre')
                    ->required(),

                Textarea::make('description')
                    ->label('Descripción')
                    ->columnSpanFull(),

                Select::make('category')
                    ->label('Categoría')
                    ->required()
                    ->options([
                        'concert' => 'Concierto',
                        'sport'   => 'Deporte',
                        'theater' => 'Teatro',
                    ]),

                FileUpload::make('image_url')
                    ->label('Imagen')
                    ->image(),

                Select::make('status')
                    ->label('Estado')
                    ->required()
                    ->default('draft')
                    ->options([
                        'draft'     => 'Borrador',
                        'published' => 'Publicado',
                        'cancelled' => 'Cancelado',
                    ]),

                DateTimePicker::make('event_date')
                    ->label('Fecha del evento')
                    ->required(),
            ]);
    }
}
