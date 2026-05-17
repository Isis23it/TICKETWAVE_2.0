<?php

namespace App\Filament\Resources\Venues\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

/**
 * Formulario para crear y editar Recintos.
 * Campos en español con validaciones y valores por defecto.
 */
class VenueForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nombre')
                    ->required()
                    ->validationMessages([
                        'required' => 'El nombre del recinto es obligatorio.',
                    ]),

                TextInput::make('city')
                    ->label('Ciudad')
                    ->required()
                    ->validationMessages([
                        'required' => 'La ciudad es obligatoria.',
                    ]),

                TextInput::make('state')
                    ->label('Estado')
                    ->required()
                    ->validationMessages([
                        'required' => 'El estado es obligatorio.',
                    ]),

                TextInput::make('neighborhood')
                    ->label('Colonia'),

                TextInput::make('country')
                    ->label('País')
                    ->required()
                    ->default('México'),

                TextInput::make('postal_code')
                    ->label('Código postal'),

                TextInput::make('address')
                    ->label('Dirección'),

                TextInput::make('capacity')
                    ->label('Capacidad')
                    ->required()
                    ->numeric()
                    ->validationMessages([
                        'required' => 'La capacidad es obligatoria.',
                        'numeric'  => 'La capacidad debe ser un número.',
                    ]),

                TextInput::make('latitude')
                    ->label('Latitud')
                    ->numeric(),

                TextInput::make('longitude')
                    ->label('Longitud')
                    ->numeric(),

                FileUpload::make('image_url')
                    ->label('Imagen')
                    ->image()
                    ->disk('public')
                    ->directory('venues')
                    ->maxSize(2048),

                Toggle::make('active')
                    ->label('Activo')
                    ->required()
                    ->default(true),
            ]);
    }
}